<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Stripe\Checkout\Session;
use App\Mail\MembershipReactive;
use App\Mail\MembershipPaused;
use App\Mail\MembershipRenew;
use App\Mail\MembershipCancelled;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::where('user_id', auth()->id())->get();
        $plans = SubscriptionPlan::get();
        return view('subscriptions.index', compact('subscriptions','plans'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'plan' => 'required|string',
        ]);

        $subscription = new Subscription([
            'user_id' => auth()->id(),
            'plan' => $request->plan,
            'status' => 'active',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonth(),
            'payment_status' => 'completed',
        ]);
        $subscription->save();

        return redirect()->route('user.subscription.index');
    }


    public function cancel(Request $request)
    {
        $user = auth()->user();
        $subscription = Subscription::where('id', $request->subscriptionId)->first();
       if ($request->subscriptionStatus == "reactive") {
        
            if ($subscription && $subscription->end_date > now()) {

                // First, cancel any old subscriptions (precaution)
                Subscription::where('user_id', $user->id)->update(['status' => 'cancelled']);

                // Reactivate this one
                $subscription->update(['status' => 'active']);

                $link = route('user.subscription.index');

                if ($user->is_subscribed == 1) {
                    // Optional: Send reactivation mail
                    // Mail::to($user->email)->send(new SubscriptionReactivated($user, $link));
                }

                return back()->with('success', 'Subscription reactivated successfully.');
            }

        } else {

            if ($subscription) {
                $subscription->update(['status' => 'cancelled']);

                $link = route('user.subscription.index');

                if ($user->is_subscribed == 1) {
                    if (!empty($user->local)) {
                        App::setLocale($user->local);
                    }
                    Mail::to($user->email)->send(new MembershipCancelled($user, $link));
                    App::setLocale(config('app.locale'));
                }

                return back()->with('success', 'Subscription cancelled successfully.');
            }
        }


    }

    // Pause Subscription
    public function pause(Request $request)
    {
        $user = auth()->user();
        $subscription = Subscription::where('user_id', auth()->id())->first();
        if($subscription->status == 'paused'){
                $subscription->update(['status' => 'active',]);
                if($user->is_subscribed == 1){
                    $link = route('users.show-user', auth()->id());
                    if (!empty($user->local)) {
                        App::setLocale($user->local);
                    }
                    Mail::to($user->email)->send(new MembershipReactive($user, $link));
                    App::setLocale(config('app.locale'));
                }
                return back();
        }else{
            $request->validate([
                'paused_until' => 'nullable|date|after:today'
            ]);
            if ($subscription) {
                $pausedUntil = $request->paused_until ?? null;
                $subscription->update(['status' => 'paused','paused_until' => $pausedUntil,]);

                $link = route('user.subscription.pause');
                if($user->is_subscribed == 1){
                    if (!empty($user->local)) {
                        App::setLocale($user->local);
                    }
                    Mail::to($user->email)->send(new MembershipPaused($user, $link, $pausedUntil));
                    App::setLocale(config('app.locale'));
                }

                return back();
            }
        }
    }


    // Extend Subscription
    public function extend(Request $request)
    {
        $request->validate([
            'months' => 'required'
        ]);
 
        $user = auth()->user();

        $planId = $request->months;

        $subscription = Subscription::where('user_id', auth()->id())->first();
        $plans = SubscriptionPlan::where('id',$planId)->first();
        
        $newDate = Carbon::parse($subscription->end_date)->addMonths($plans->duration);
        
        session([
            'request_process' => 'Extend-Subscription',
            'new_date' => $newDate,
            'subscription_id' => $subscription->id,
            'backUrl' => route('user.subscription.index'),
        ]);

        return app(PaymentController::class)->createPaymentPreference($planId);

        if ($subscription && $subscription->status === 'active') {
            $newDate = Carbon::now()->addDays($request->days);

            $link = '<a class="nav-link mt-1" 
            href="' . (getMatchProfile() !== 0 ? route('users.show-user', getMatchProfile()) : 'javascript:void(0);') . '" 
            onclick="' . (getMatchProfile() === 0 ? 'showNoProfileWarning()' : '') . '"
          style="background-color:#595959;border-color:#595959;color:white;padding: 10px 25px;border-radius:6px;text-decoration:none;font-size: 16px;text-align: center;text-transform: uppercase;">'.__('controllerText.PaymentController_2').'</a>';
         if($user->is_subscribed == 1){
            if (!empty($user->local)) {
                App::setLocale($user->local);
            }
            Mail::to($user->email)->send(new MembershipRenew($user, $link));
            App::setLocale(config('app.locale'));
         }
            return back();
        }
        return back();
    }

    public function plans()
    {
        $plans = SubscriptionPlan::get();
        return view('subscriptions.plan', compact('plans'));
    }

    public function unsubscribe(User $user)
    {
        $userId = auth()->user()->id;
        $user->where('id',$userId)->update(['is_subscribed' => 0]);
        
        return view('subscriptions.unsubscribed');
    }
}


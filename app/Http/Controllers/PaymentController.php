<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\MercadoPagoService;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use Carbon\Carbon;
use Stripe\Checkout\Session;

use App\Mail\MembershipRenew;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Mail\SendPaymentSuccess;
use Illuminate\Support\Facades\App;

class PaymentController extends Controller
{
    protected $mercadoPagoService;
    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        $this->mercadoPagoService = $mercadoPagoService;
    }
    public function createPaymentPreference($id)
    {

        $plans = SubscriptionPlan::findorfail($id);
        $discountValue  = session('discount', 0);
        $discountType  = session('discount_type', 'amount');
        

        if ($discountType === 'percentage') {
            $calculatedDiscount = ($discountValue / 100) * $plans->price;
        } else { 
            $calculatedDiscount = $discountValue;
        }

        $finalPrice = max(0, $plans->price - $calculatedDiscount);

        $items = [
            [
            'title' => $plans->name,
            'quantity' => 1,  
            'unit_price' => intval(round($finalPrice)),
            ]
        ];
        $preference = $this->mercadoPagoService->createPreference($items, $plans->id);

        if (!$preference || !isset($preference->init_point)) {
            return back()->with('error', __('controllerText.PaymentController_1'));
        }

        return redirect()->away($preference->init_point);
    }

    public function paymentSuccess(Request $request) 
    {
       
        $requestProcess = session('request_process');
        session()->forget(['applied_promocode', 'discount'.'discount_type']);
        $startdate = now();
        $enddate = "";
        if($requestProcess == 'Extend-Subscription'){
            $user = auth()->user();
            $newDate = session('new_date');
            $enddate = $newDate;
            $subscription_id = session('subscription_id');
            $backUrl = session('backUrl');
            $subscription = Subscription::where('user_id', auth()->id())->where('id',$subscription_id)->first();

            if($subscription){
                $subscription->update(['status'=> 'active', 'end_date' => $newDate,'renew_status' => 0]);
            }

            $redirectUrl =$backUrl;
            session()->forget(['request_process', 'new_date', 'subscription_id','backUrl']);

            if ($subscription && $subscription->status === 'active') {
    
                $link = '<a class="nav-link mt-1" 
                href="' . (getMatchProfile() !== 0 ? route('users.show-user', getMatchProfile()) : 'javascript:void(0);') . '" 
                onclick="' . (getMatchProfile() === 0 ? 'showNoProfileWarning()' : '') . '"
                >'.__('controllerText.PaymentController_2').'</a>';
                if($user->is_subscribed == 1){
                    if (!empty($user->local)) {
                        App::setLocale($user->local);
                    }
                    Mail::to($user->email)->send(new MembershipRenew($user, $link));
                    App::setLocale(config('app.locale'));
                }
            }

            return view('payment.success',compact('redirectUrl'));
        }else{
            $paymentId = $request->get('payment_id');
            $checkStatus = $this->mercadoPagoService->getPaymentStatus($paymentId);
            $status = $request->get('status') ?? $checkStatus;
            $subscriptionId = $request->get('external_reference') ?? 2; 
            $user = auth()->user();
            $enddate = "";
            if ($status === 'approved' || $status == "approved") {
                $plans = SubscriptionPlan::findOrFail($subscriptionId); 
                $enddate = now()->copy()->addMonths($plans->duration);
                $lastEndDate = Subscription::where('user_id', $user->id)->max('end_date');
                $startDate = $lastEndDate ? Carbon::parse($lastEndDate) : now();
                $subscription = Subscription::where('user_id', auth()->id())->where('status', 'active')->exists();

                if($subscription){
                $status = 'pending';
                }else{
                $status = 'active';
                }
                
                // Create new subscription
                Subscription::create([
                'user_id' => $user->id,
                'plan' => $plans->id,
                'status' => $status,
                'start_date' => now(),
                'end_date' => now()->copy()->addMonths($plans->duration),
                'payment_status' => 'completed',
                'payment_id' => $paymentId,
                ]);
            }
            $redirectUrl = route('profile.edit');
            return view('payment.success',compact('redirectUrl'));
        }
        if (!empty($user->local)) {
            App::setLocale($user->local);
        }
        Mail::to($user->email)->send(new SendPaymentSuccess($user, $startdate, $enddate));
        App::setLocale(config('app.locale'));
    }

    public function paymentFailure(Request $request)
    {
        $requestProcess = session('request_process');

        if($requestProcess == 'Extend-Subscription') {
            $user = auth()->user();
            $newDate = session('new_date');
            $subscription_id = session('subscription_id');
            $backUrl = session('backUrl');
            $subscription = Subscription::where('user_id', auth()->id())->where('id',$subscription_id)->first();
            if ($subscription) {
            $subscription->update(['status' => 'active','end_date' => $newDate,'is_renew' => 0]);
            }
            $redirectUrl =$backUrl;
            session()->forget(['request_process', 'new_date', 'subscription_id','backUrl']);
            return view('payment.failure',compact('redirectUrl'));
        }else{
            $paymentId = $request->get('payment_id');
            $checkStatus = $this->mercadoPagoService->getPaymentStatus($paymentId);
            $status = $request->get('status') ?? $checkStatus;
            $subscriptionId = $request->get('external_reference') ?? 2;

            if($status === 'rejected') {
                $user = auth()->user();
                $plans = SubscriptionPlan::findOrFail($subscriptionId);
                Subscription::create([
                'user_id' => $user->id,
                'plan' => $plans->id,
                'status' => 'cancel',
                'start_date' => now(),
                'end_date' => now()->addMonths($plans->duration),
                'payment_status' => 'failed',
                'payment_id' =>$paymentId,
                ]);
            }
            $redirectUrl = route('profile.edit');
            return view('payment.failure',compact('redirectUrl'));
        }
    }

    public function paymentPending(Request $request)
    {
        $requestProcess = session('request_process');

        if($requestProcess == 'Extend-Subscription') {
            if($requestProcess === 'Extend-Subscription') {
                $user = auth()->user();
                $newDate = session('new_date');
                $subscription_id = session('subscription_id');
                $backUrl = session('backUrl');
                $subscription = Subscription::where('user_id', auth()->id())->where('id',$subscription_id)->first();
                if ($subscription) {
                $subscription->update(['end_date' => $newDate]);
                }
                $redirectUrl =$backUrl;
                session()->forget(['request_process', 'new_date', 'subscription_id','backUrl']);
                return view('payment.failure',compact('redirectUrl'));
            }
                $redirectUrl =$backUrl;
                session()->forget(['request_process', 'new_date', 'subscription_id','backUrl']);
                return view('payment.failure',compact('redirectUrl'));
        }else{
            $paymentId = $request->get('payment_id');
            $checkStatus = $this->mercadoPagoService->getPaymentStatus($paymentId);
            $status = $request->get('status') ?? $checkStatus;
            $subscriptionId = $request->get('external_reference') ?? 2;
            $user = auth()->user();
            if ($status == 'in_process') {
                $user = auth()->user();
                $plans = SubscriptionPlan::findOrFail($subscriptionId);
                $lastEndDate = Subscription::where('user_id', $user->id)->max('end_date');
                $startDate = $lastEndDate ? Carbon::parse($lastEndDate) : now();
                Subscription::create([
                    'user_id' => $user->id,
                    'plan' => $plans->name,
                    'status' => 'pending',
                    'start_date' => $startDate,
                    'end_date' => $startDate->copy()->addMonths($plans->duration),
                    'payment_status' => 'pending',
                    'payment_id' => $paymentId,
                ]);

                $redirectUrl = route('profile.edit');
                return view('payment.pending',compact('redirectUrl'));
            }
            if ($status === 'approved' || $status == "approved") {
                $plans = SubscriptionPlan::findOrFail($subscriptionId); 
                $enddate = now()->copy()->addMonths($plans->duration);
                $lastEndDate = Subscription::where('user_id', $user->id)->max('end_date');
                $startDate = $lastEndDate ? Carbon::parse($lastEndDate) : now();
                $subscription = Subscription::where('user_id', auth()->id())->where('status', 'active')->exists();

                if($subscription){
                $status = 'pending';
                }else{
                $status = 'active';
                }
                
                // Create new subscription
                Subscription::create([
                'user_id' => $user->id,
                'plan' => $plans->id,
                'status' => $status,
                'start_date' => now(),
                'end_date' => now()->copy()->addMonths($plans->duration),
                'payment_status' => 'completed',
                'payment_id' => $paymentId,
                ]);
                $redirectUrl = route('profile.edit');
                return view('payment.success',compact('redirectUrl'));
            }
        }
    }
}
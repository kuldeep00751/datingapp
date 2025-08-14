<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function createStripeSession(Request $request)
    {
        // Your Stripe Secret Key
        // Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a Checkout Session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $request->plan_name,
                    ],
                    'unit_amount' => $request->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function paymentSuccess(Request $request)
    {
        // return view('payment.success');
        // Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::retrieve($request->get('session_id'));

        if ($session && $session->payment_status === 'paid') {
            $user = auth()->user();

            Subscription::create([
                'user_id' => $user->id,
                'plan' => $session->metadata->plan_name,
                'status' => 'active', 
                'start_date' => now(),
                'end_date' => now()->addMonths($request->duration),
                'payment_status' => 'paid',
            ]);

            return redirect()->route('subscriptions.index')->with('success', 'Subscription activated successfully!');
        }

        return redirect()->route('subscriptions.index')->with('error', 'Payment verification failed!');
    }

    public function paymentCancel()
    {
        return redirect()->route('subscriptions.index')->with('error', 'Payment was canceled!');
    }
}

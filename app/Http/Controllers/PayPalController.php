<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayPalService;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use Carbon\Carbon;

class PayPalController extends Controller
{
    protected $paypalService;

    public function __construct(PayPalService $paypalService)
    {
        $this->paypalService = $paypalService;
    }

    // Create a PayPal payment
    public function createPaymentPayPal($id)
    {
        $plans = SubscriptionPlan::findOrFail($id);
        
        // $response = $this->paypalService->createPayment($plans->price, $plans->id);

        // if (isset($response['links'])) {
        //     foreach ($response['links'] as $link) {
        //         if ($link['rel'] === 'approve') {
        //             header("Location: " . $link['href']);
        //             exit;
        //         }
        //     }
        // }
        
        $user = auth()->user();
        $lastEndDate = Subscription::where('user_id', $user->id)->max('end_date');
        $startDate = $lastEndDate ? Carbon::parse($lastEndDate) : now();
        $status = $lastEndDate ? 'pending' : 'active';
        $randomNumber = mt_rand(1, 100000000);
        Subscription::create([
            'user_id' => $user->id,
            'plan' => $plans->name,
            'status' => $status,
            'start_date' => $startDate,
            'end_date' => $startDate->copy()->addMonths($plans->duration),
            'payment_status' => 'completed',
            'payment_id' => $randomNumber, // Save the PayPal order ID
        ]);

        return view('payment.success');

        
        return redirect()->back()->with('error', 'Unable to create PayPal transaction.');
    }

    // Handle successful payment
    public function paymentSuccess(Request $request)
    { //dd($request->all());
        $response = $this->paypalService->capturePayment($request->token);
       
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Capture required data from the response
            $plans = SubscriptionPlan::findOrFail($response['purchase_units'][0]['reference_id']);
            $user = auth()->user();
            $lastEndDate = Subscription::where('user_id', $user->id)->max('end_date');
            $startDate = $lastEndDate ? Carbon::parse($lastEndDate) : now();
            $status = $lastEndDate ? 'pending' : 'active';

            // Create a new subscription
            Subscription::create([
                'user_id' => $user->id,
                'plan' => $plans->name,
                'status' => $status,
                'start_date' => $startDate,
                'end_date' => $startDate->copy()->addMonths($plans->duration),
                'payment_status' => 'completed',
                'payment_id' => $response['id'], // Save the PayPal order ID
            ]);

            return view('payment.success'); // Render success page
        }

        return redirect()->route('payment.failure')->with('error', 'Payment not completed.');
    }

    // Handle failed payment
    public function paymentFailure()
    {   
        return view('payment.failure');
    }

}

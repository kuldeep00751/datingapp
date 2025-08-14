<?php

namespace App\Services;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalService
{
    public function createPayment($amount, $planId)
    {
        
        $provider = new PayPalClient;
       
        $provider->setApiCredentials(config('paypal'));
       
        $paypalToken = $provider->getAccessToken();
        
        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "reference_id" => $planId,
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount,
                    ],
                    // "shipping" => [
                    //     "name" => [
                    //         "full_name" => "Kuldeep Kumar",
                    //     ],
                    //     "address" => [
                    //         "address_line_1" => "123 Main Street",
                    //         "address_line_2" => "Apt 4B",
                    //         "admin_area_2" => "Alaska", // City
                    //         "admin_area_1" => "AK", // State
                    //         "postal_code" => "99501",
                    //         "country_code" => "US"
                    //     ],
                    // ],
                ],
            ],
            "application_context" => [
                "return_url" => route('paypal.success'), 
                "cancel_url" => route('paypal.cancel'), 
                "user_action" => "PAY_NOW", 
                // "shipping_preference" => "SET_PROVIDED_ADDRESS", 
            ],
        ]);
        
       return $order;
    }

    public function capturePayment($orderId)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        return $provider->capturePaymentOrder($orderId);
    }
}

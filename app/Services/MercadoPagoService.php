<?php

namespace App\Services;

use MercadoPago\Preference;
use MercadoPago\Item;
use MercadoPago\Payment;
use MercadoPago\Customer;
use MercadoPago\PaymentMethod;
use MercadoPago\Card;
use MercadoPago\CardToken;
use MercadoPago\Payer;
use MercadoPago\Payment\PaymentStatus;

class MercadoPagoService
{
    public function __construct()
    {
        // Set Mercado Pago credentials
        \MercadoPago\SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
    }

    public function createPreference($items, $id)
    {
        $preference = new Preference();

        $itemsArray = [];
       

        foreach ($items as $itemData) {
            $item = new Item();
            $promoCode = "PROMO1000"; 
            $discountAmount = 0.00;
            $item->title = $itemData['title'];
            $item->quantity = (int)$itemData['quantity'];

            // Apply discount by reducing unit price
            if ($discountAmount > 0) {
                $item->unit_price = max(0, $itemData['unit_price'] - $discountAmount); // Prevent negative prices
            } else {
                $item->unit_price = $itemData['unit_price'];
            }

            $itemsArray[] = $item;
        }

        $preference->items = $itemsArray;
        $preference->currency_id = 'COP';
        $preference->back_urls = [
            'success' => route('payment.success'),
            'failure' => route('payment.failure'),
            'pending' => route('payment.pending'),
        ];

        $preference->auto_return = "approved";
        $preference->external_reference = $id;
       
        // Save preference
        $preference->save();

        return $preference;
    }

    public function createPayment($paymentData)
    {
        // Payment creation
        $payment = new Payment();
        $payment->transaction_amount = $paymentData['amount'];
        $payment->token = $paymentData['token'];
        $payment->description = $paymentData['description'];
        $payment->installments = $paymentData['installments'];
        $payment->payment_method_id = $paymentData['payment_method_id'];
        $payment->payer = new Payer();
        $payment->payer->email = $paymentData['email'];
        // Save and execute payment
        $payment->save();
        return $payment;
    }

    public function getPaymentStatus($paymentId)
    {
        // Retrieve the payment status using the payment ID
        $payment = Payment::find_by_id($paymentId);
        return $payment->status;
    } 

    public function getPaymentAmount($paymentId)
    {
        try {
            $payment = Payment::find_by_id($paymentId);
            return $payment->transaction_amount;
        } catch (\Exception $e) {
            return null;
        }
    } 
}

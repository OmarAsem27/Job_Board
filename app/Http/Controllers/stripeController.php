<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;

class stripeController extends Controller
{
    public function stripe(Request $request)
    {
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        $stripe = new \Stripe\StripeClient(config("stripe.stripe_sk"));
        $response = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => ['name' => $request->product_name],
                        'unit_amount' => $request->price * 100,
                    ],
                    'quantity' => $request->quantity,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success-stripe') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel-stripe')
        ]);
        // dd($response);
        if (isset($response->id) && $response->id != '') {
            session()->put('product_name', $request->product_name);
            session()->put('quantity', $request->quantity);
            session()->put('price', $request->price);
            return redirect($response->url);
        } else {
            return redirect()->route('cancel-stripe');
        }
    }
    public function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
        $response = $stripe->checkout->sessions->retrieve($request->session_id);
        // dd($response);
        $payment = new payment();
        $payment->payment_id = $response->id;
        $payment->product_name = session()->get('product_name');
        $payment->quantity = session()->get('quantity');
        $payment->amount = session()->get('price');
        $payment->currency = $response->currency;
        $payment->payer_name = $response->customer_details->name;
        $payment->payer_email = $response->customer_details->email;
        $payment->payment_status = $response->status;
        $payment->payment_method = "Stripe";
        $payment->save();

        session()->forget('product_name');
        session()->forget('quantity');
        session()->forget('price');

        return "Payment with Stripe is successful";
    }
    public function cancel()
    {
        return "Payment with Stripe is rejected";
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\Stripe as StripeGateway;
use Throwable;


class StripeController extends Controller
{
    public function initiatePayment(Request $request)
    {
        StripeGateway::setApiKey(env('STRIPE_PV_KEY'));

        try {
            $order = Order::find($request->order_id);
            $paymentIntent = PaymentIntent::create([
                'amount' => $order->order_price * 100, // Multiply as & when required
                'currency' => $request->currency,
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            // Save the $paymentIntent->id to identify this payment later
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        return [
            'token' => $paymentIntent->id,
            'client_secret' => $paymentIntent->client_secret
        ];
    }
    public function completePayment(Request $request){
        $stripe = new StripeClient(env('STRIPE_PV_KEY'));

        $paymentDetail = $stripe->paymentIntents->retrieve($request->token);

        if($paymentDetail->status != 'succeeded'){
            return [
                'message' => (String) "erreur Stripe"
            ];
        }
    }

    public function failPayment(Request $request){

    }
}

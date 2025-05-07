<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use Razorpay\Api\Api;

use App\Models\OrderItem;

use Illuminate\Http\Request;

class RazorpayController extends Controller
{
    public function payment(Request $request)
    {
        $razorpayPaymentId = $request->input('razorpay_payment_id');

        if ($razorpayPaymentId) {
            try {
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $payment = $api->payment->fetch($razorpayPaymentId);
                $response = $payment->capture(['amount' => $payment['amount']]);

                // Save order
                $order = new Order;
                $order->payment_id = $response['id'];
                $order->amount = $response['amount'] / 100; // Convert paise to rupees
                $order->status = $response['status'];
                $order->user_id = auth()->user()->id ?? null;
                $order->save();

                // Save order items
                $cart = session()->get('cart', []);
                foreach ($cart as $id => $item) {
                    $orderItem = new OrderItem;
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $id;
                    $orderItem->name = $item['name'];
                    $orderItem->price = $item['price'];
                    $orderItem->quantity = $item['quantity'];
                    $orderItem->save();
                }

                // Clear cart
                $order = Order::with('items')->findOrFail($orderId);
                session()->forget('cart');
                return view('ordersuccess', compact('order'));

                // return redirect(`/order-success/$order->id`)->with('success', 'Payment successful!');

            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('error', 'Payment ID not found.');
    }

    public function orderSuccess($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        return view('order-success', compact('order'));
    }



    public function createOrder(Request $request)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        
        $orderData = [
            'receipt' => 'order_' . uniqid(),
            'amount' => $request->amount, // amount in paise
            'currency' => 'INR',
            'notes' => [
                'plan_id' => $request->plan_id,
                'plan_name' => $request->plan_name
            ]
        ];

        $order = $api->order->create($orderData);

        return response()->json([
            'order_id' => $order->id,
            'amount' => $order->amount
        ]);
    }
}
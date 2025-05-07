<?php


namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class stripecontroller extends Controller
{
    /**
     * Constructor to enforce authentication
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['cancel']);
    }

    /**
     * Create a Stripe Checkout Session
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createCheckoutSession(Request $request)
    {
        try {
            // Set Stripe API key
            Stripe::setApiKey(config('services.stripe.secret'));

            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }

            $lineItems = [];

            foreach ($cart as $id => $item) {
                $productData = [
                    'name' => $item['name'],
                ];
                
                // Only include description if it exists and is not empty
                if (!empty($item['description'])) {
                    $productData['description'] = $item['description'];
                }
                
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'inr',
                        'unit_amount' => round($item['price'] * 100), // Convert to cents/paise and ensure integer
                        'product_data' => $productData,
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            // Shipping fixed for example (₹20)
            $shipping = 20.00;

            // Add shipping as a separate line item
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'inr',
                    'unit_amount' => round($shipping * 100), // Convert to paise
                    'product_data' => [
                        'name' => 'Shipping',
                        // Include description only if needed
                        'description' => 'Standard Shipping',
                    ],
                ],
                'quantity' => 1,
            ];

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => url('/order-success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => url('/stripe/cancel'),
            ]);

            return redirect($session->url);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Payment processing error: ' . $e->getMessage());
        }
    }

    /**
     * Payment success handler
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function success(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $sessionId = $request->get('session_id');
            if (!$sessionId) {
                return redirect('/cart')->with('error', 'Invalid session');
            }

            $session = Session::retrieve($sessionId);
            $amount = $session->amount_total / 100;

            // Create Order
            $order = Order::create([
                'payment_id' => $session->payment_intent,
                'amount' => $amount,
                'status' => 'paid',
                'user_id' => Auth::id(),
            ]);

            // Save order items
            $cart = session()->get('cart', []);
            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            // Clear the cart after successful order
            session()->forget('cart');

            return view('ordersuccess', compact('order'));
        } catch (Exception $e) {
            return redirect('/cart')->with('error', 'Error processing order: ' . $e->getMessage());
        }
    }

    /**
     * Cancel page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel()
    {
        return redirect('/cart')->with('error', 'Payment was canceled.');
    }
}
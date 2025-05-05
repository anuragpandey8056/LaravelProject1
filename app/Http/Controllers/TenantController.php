<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use App\Models\Tenant;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccessMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::with('domains')->get();
        return view('tenancy.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenancy.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!empty($request->razorpay_payment_id)){
            DB::beginTransaction();
            
            try {
                $validData = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'domain_name' => 'required|string|max:255',
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                // First check if domain already exists
                $domainToCheck = $validData['domain_name'] . '.' . config('app.domain');
                $domainExists = DB::table('domains')->where('domain', $domainToCheck)->exists();
                
                if ($domainExists) {
                    return back()->with('error', "The domain {$domainToCheck} is already taken. Please choose another domain name.");
                }

                // Verify Razorpay payment
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

                $attributes = [
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                ];

                // Signature verification
                $api->utility->verifyPaymentSignature($attributes);

                // Tenant creation
                $tenant = Tenant::create([
                    'name' => $validData['name'],
                    'email' => $validData['email'],
                    'password' =>$validData['password'],
                ]);

                // Domain creation
                $tenant->domains()->create([
                    'domain' => $domainToCheck,

                ]);

                // Extract numeric amount from the price string (remove "INR" and any non-numeric characters)
                $amount = $request->plan_price;
                if (is_string($amount) && preg_match('/INR\s*(\d+(\.\d+)?)/', $amount, $matches)) {
                    $amount = $matches[1]; // Extract just the number
                }

                // Create payment record manually using direct SQL to avoid model binding issues
                DB::table('payments')->insert([
                    'tenant_id' => $tenant->getKey(), // Use getKey() to get primary key value
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'amount' => $amount,
                    'status' => 'completed',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Email details
                $tenantData = [
                    'name' => $tenant->name,
                    'email' => $tenant->email,
                    'domain' => $domainToCheck,
                    'amount' => $amount,
                ];

                Mail::to($tenant->email)->send(new PaymentSuccessMail($tenantData));
                
               
            return view('payment_success')->with('tenantData', [
                'name' => 'User',
                'amount' => 0,
                'domain' => 'yourdomain.com'
            ]);
            } catch (\Exception $e) {
               
                Log::error('Razorpay payment verification failed: ' . $e->getMessage());
                return view('payment_success')->with('tenantData', [
                    'name' => 'User',
                    'amount' => 0,
                    'domain' => 'yourdomain.com'
                ]);
            }
        }

        return back()->with('error', 'Invalid payment data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
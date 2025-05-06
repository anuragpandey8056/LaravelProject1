<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //
    public function getsubscription(){
        $plan=Plan::with('features')->get();
      

        return view ('subscription',compact('plan'));
    }


    public function subscriptiondashboard()
    {
        // dd("heelo");
        $tenants = Tenant::with('domains')->get();
        // Add any logic/data fetching here
        return view('subscriptiondash.dashboard',compact('tenants'));
    }


    public function subscriptiondashboardplan()
    {
        
        
        return view('subscriptiondash.plans');
    }



}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\product;
use Illuminate\Http\Request;



class admincontroller extends Controller
{
    public function adminindex(){

      $productscount = product::latest()->get()->count();
      $totalsale=product::sum('price');
      $totalcategory=product::with('category')->get()->count();
    
      $totalUser=User::get()->count();
        return view('adminviews.adminindex',compact('productscount','totalUser','totalsale','totalcategory'));
     }

     public function adminviewproduct(Request $request){
        $products = product::latest()->get();
      
        return view('adminviews.viewproduct',compact('products'));
     }



}

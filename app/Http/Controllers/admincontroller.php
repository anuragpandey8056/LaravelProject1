<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;


class admincontroller extends Controller
{
    public function adminindex(){
        return view('adminviews.adminindex');
     }

     public function adminviewproduct(Request $request){
        $products = product::latest()->get();
        return view('adminviews.viewproduct',compact('products'));
     }



}

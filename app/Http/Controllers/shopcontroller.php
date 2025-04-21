<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class shopcontroller extends Controller
{
    public function shop()
    {
    
    $product=product::latest()->get();
    
    
 
     return view('shop',compact('product'));
    }
}

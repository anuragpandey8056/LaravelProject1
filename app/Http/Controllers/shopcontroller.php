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

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image,
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect('/')->with('success', 'Product added to cart successfully!');
    }
    
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('addtocart', compact('cart'));
    }


    
public function updateCart(Request $request, $id)
{
    if($request->has('quantity') && isset($id)) {
        $cart = session()->get('cart');
        $cart[$id]["quantity"] = $request->quantity;
        session()->put('cart', $cart);
    }
    
    return redirect()->route('cart')->with('success', 'Cart updated successfully!');
}

public function removeCart($id)
{
    $cart = session()->get('cart');
    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    
    return redirect()->route('cart')->with('success', 'Product removed from cart!');
}
    
}

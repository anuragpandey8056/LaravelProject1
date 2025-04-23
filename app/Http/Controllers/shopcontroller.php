<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;

class shopcontroller extends Controller
{
    public function shop()
    {
        $product = Product::latest()->get();
        $category = Category::latest()->get();
        $cart = session()->get('cart');

        return view('shop', compact('product', 'category', 'cart'));
    }
    
    public function filterProducts(Request $request)
    {
        $categoryId = $request->category_id;
        
        if ($categoryId) {
            $products = Product::where('category_id', $categoryId)->latest()->get();
        } else {
            $products = Product::latest()->get();
        }
        
        $productsHtml = view('partials.product_cards', compact('products'))->render();
        
        return response()->json([
            'success' => true,
            'productsHtml' => $productsHtml
        ]);
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

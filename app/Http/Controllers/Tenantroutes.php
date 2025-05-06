<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\heros;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class Tenantroutes extends Controller
{
    //

    public function default(){
       
        $activeHeroes = heros::where('status', 1)->first();
        $products = product::with('category')->get();
        $cart = session()->get('cart');
        // dd($activeHeroes);
       return view('home',compact('activeHeroes','products','cart'));
    }

    public function store(Request $request)
   {
    //    dd("hiii");
       $request->validate([
           'name' => 'required|min:1|max:10',
           'price' => 'required',
           'category' => 'required',
           'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
       Log::error("Product not found with ");
        
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            
            $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            
            $img = $manager->read($request->file('image'));
            $img->resize(800, 400);
            $img->save(public_path('Upload/products/' . $name_gen));
            
            $save_url = 'Upload/products/' . $name_gen;
            
            $product = product::create([
                'name' => $request->name,
                'price' => $request->price,
                'cateory_id' => $request->category,
                'image' => $save_url,
            ]);
            
            return response()->json([
                'success' => 'Product saved successfully.',
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'category' => category::where('id',$request->category)->value('categoryname'),
                    'image' => asset($product->image),
                    ]
                ]);
            }
            
            return response()->json(['error' => 'Image upload failed.'], 422);
        }


        public function edit($id)
        {
       $product = product::findOrFail($id);
       
       return response()->json([
           'product' => $product
        ]);
    }
    
    // Update a product by its ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:1|max:10',
            'price' => 'required',
           'category' => 'required',

            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
     
   
    
        
        
       $product = product::findOrFail($id);
        
        $product->name = $request->name;
        $product->price = $request->price;
        $product->cateory_id = $request->category;
        
        
        if ($request->hasFile('image')) {
           $manager = new ImageManager(new Driver());
   
           if ($product->image && Storage::exists($product->image)) {
               Storage::delete($product->image);
           }

           if ($product->image) {
               $imagePath = public_path($product->image);
       
               if (File::exists($imagePath)) {  
                   File::delete($imagePath);
               } else {
                   
               }
           } 
   
           $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
           $img = $manager->read($request->file('image'));
           $img->resize(800, 400);
           $img->save(public_path('Upload/products/' . $name_gen));
   
           $save_url = 'Upload/products/' . $name_gen;
           $product->image = $save_url;
       }
   
       $product->save();
       return response()->json([
           'success' => 'Product updated successfully.',
           'product' => [
               'id' => $product->id,
               'name' => $product->name,
               'price' => $product->price,
               'category' => category::where('id',$request->category)->value('categoryname'),
               'image' => asset($product->image),
           ]
       ]);
   }
   
   public function delete($id)
   {
       $product = product::findOrFail($id);
       
       // Delete the image file if it exists
       if ($product->image) {
           $imagePath = public_path($product->image);
           
           if (File::exists($imagePath)) {
               File::delete($imagePath);
           }
       }
       
       // Delete the product
       $product->delete();
       
       return response()->json([
           'success' => 'Product deleted successfully.'
       ]);
   }
}
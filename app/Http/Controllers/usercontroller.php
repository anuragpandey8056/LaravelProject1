<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\StudentModel;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

use Intervension\Image\Facades\Image;
use Illuminate\support\facades\storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;




class usercontroller extends Controller
{
    public function getuser(){
       return view('home');
    }

    public function getusercontact(){
        return view('contact');
     }

     public function getuserservice(){
        return view('service');
     }
     public function getuserabout(){
        return view('about');
     }
   //   public function getusercontact2(){
   //      return view('contact2');
   //   }

     public function getadduser(Request $request){
      $request->validate([
         'name'=>"required|max:255|string",
         'class'=>"required|max:255|string",
         'mobile'=>"required|string|between:9,11",
         'email'=>"required|regex:/(.+)@(.+)\.(.+)/i",
         'idea'=>"required|max:255|string"

      ]);
      StudentModel::create([
         'name'=>$request->name,
         'class'=>$request->class,
         'mobile'=>$request->mobile,
         'email'=>$request->email,
         'idea'=>$request->idea,
         

      ]);
       return redirect()->back()->with('status','Inserted');
     }


   public function getshowdata(){
      $student=StudentModel::get();
      return view('showdata',["data"=>$student]);
   }

   public function getdelete(int $id){
     $del= StudentModel::findOrFail($id);
     $del->delete();
 
     return redirect()->back()->with('status','Deleted');
   }

   public function getedit(int $id){
      $student=StudentModel::findOrFail($id);
      return view('edit',["data"=>$student]);
   }

   public function getupdate(int $id, Request $request){
      // $student=StudentModel::findOrFail($id);
      $request->validate([
         'name'=>"required|max:255|string",
         'class'=>"required|max:255|string",
         'mobile'=>"required|numeric|between:9,11",
         'email'=>"required|regex:/(.+)@(.+)\.(.+)/i",
         'idea'=>"required|max:255|string"

      ]);
      StudentModel::findOrFail($id)->update([
         'name'=>$request->name,
         'class'=>$request->class,
         'mobile'=>$request->mobile,
         'email'=>$request->email,
         'idea'=>$request->idea
      ]);
      return redirect('showdata')->with('staus','updated');
     
   }





//AJAX


   public function getusercontact2(Request $request)
   {
       $products = product::latest()->get();
   
       return view('contact2', compact('products'));
   }


   //add product model
   public function store(Request $request)
   {

       $request->validate([
           'name' => 'required|min:1|max:10',
           'price' => 'required',
           'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Log::error("Product not found with ");
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
               'image' => $save_url,
           ]);
   
           return response()->json([
               'success' => 'Product saved successfully.',
               'product' => [
                   'id' => $product->id,
                   'name' => $product->name,
                   'price' => $product->price,
                   'image' => asset($product->image),
               ]
           ]);
       }
   
       return response()->json(['error' => 'Image upload failed.'], 422);
   }






   // Edit a product by its ID
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
           'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
       ]);
   
       $product = product::findOrFail($id);
    //   Log::error("Product not found with ",$product);
  

   
       $product->name = $request->name;
       $product->price = $request->price;
   
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
               'image' => asset($product->image),
           ]
       ]);
   }
   


   // Delete a product by its ID
   public function delete($id)
   {
       $product = product::find($id);
   
       if (!$product) {
           
           return response()->json(['error' => 'Product not found'], 404);
       }
   
       // Log::info("Found product: " . $product->name);
   
       if ($product->image) {
           $imagePath = public_path($product->image);
   
           if (File::exists($imagePath)) {
               File::delete($imagePath);
               // Log::info("Image deleted at: $imagePath");
           } else {
               // Log::warning("Image not found at: $imagePath");
           }
       } else {
           // Log::warning("No image field for product: $id");
       }
   
       $product->delete();
       // Log::info("Product deleted: $id");
   
       return response()->json(['success' => 'Product deleted successfully']);
   }
 
  
      
  
}

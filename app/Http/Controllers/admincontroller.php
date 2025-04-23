<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\heros;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;




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

   



    public function addadminhero(){
    $heros = heros::latest()->get();

    return view('adminviews.adminhero',compact('heros'));
    }

    public function adminBlog(Request $request)
    {
        $blogs = Blog::all();
        $post = null;
        $edit = false;

        if ($request->has('edit') && $request->has('id')) {
            $post = Blog::find($request->id);
            $edit = true;
        }

        return view('adminviews.adminblog', compact('blogs', 'post', 'edit'));
    }

    // Store a new blog
    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        Log::error("Product not found with ");

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('Upload/About', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);
        return redirect()->route('adminblog')->with('success', 'Blog created successfully.');
    }

    // Update an existing blog
    public function updateBlog(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $blog->image;
        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $imagePath = $request->file('image')->store('Upload/About', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'description' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('adminblog')->with('success', 'Blog updated successfully.');
    }

    // Delete a blog post
    // public function destroyBlog($id)
    // {
    //     $blog = Blog::findOrFail($id);
    
    //     if ($blog->image) {
    //         Storage::disk('public')->delete($blog->image);
    //     }
    //     $blog->delete();
    
    //     return redirect()->route('adminblog')->with('success', 'Blog deleted successfully.');
    // }

    public function destroyBlog($id) {
        $post = Blog::findOrFail($id);
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }
        $post->delete();
        return redirect('/adminviews.adminblog');
        }
    


    

































    public function store(Request $request)
    {
        
        $request->validate([
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        Log::error("product not found");
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            
            $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            
            $img = $manager->read($request->file('image'));
            
            $img->save(public_path('Upload/Banner/' . $name_gen));
            
            $save_url = 'Upload/Banner/' . $name_gen;
            
            Log::error("Product not found with ID");
            $hero = heros::create([

                'description' => $request->description,
                'url' => $save_url,
            ]);
    
            return response()->json([
                'success' => 'Product saved successfully.',
                'hero' => [
                    'id' => $hero->id,
                    'description' => $hero->description,
                    'status' =>'0',
                    'image' => asset($hero->url),
                ]
            ]);
        }
    
        return response()->json(['error' => 'Image upload failed.'], 422);
    }

    // Edit a product by its ID
    public function edit($id)
    {
        $hero = heros::findOrFail($id);
    
        return response()->json([
            'hero' => $hero
        ]);
    }
    
    // Update a product by its ID
    public function update(Request $request, $id)
    {
        $request->validate([

            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $hero = heros::findOrFail($id);

        $hero->description = $request->description;
        // $hero->category_id = $request->category;
    
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
    
            if ($hero->image && Storage::exists($hero->image)) {
                Storage::delete($hero->image);
            }

            if ($hero->image) {
                $imagePath = public_path($hero->image);
        
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                } else {
                    
                }
            } 
    
            $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));
            $img->resize(800, 400);
            $img->save(public_path('Upload/Banner/' . $name_gen));
    
            $save_url = 'Upload/Banner/' . $name_gen;
            $hero->image = $save_url;
        }
    
        $hero->save();
    
        return response()->json([
            'success' => 'Product updated successfully.',
            'hero' => [
                'id' => $hero->id,
                
                'description' => $hero->description,
                'status' =>'0',
                'image' => asset($hero->image),
            ]
        ]);
    }


    public function delete($id)
    {
        $hero = heros::find($id);
    
        if (!$hero) {
            // Log::error("Product not found with ID: $id");
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        // Log::info("Found product: " . $product->name);
    
        if ($hero->image) {
            $imagePath = public_path($hero->image);
    
            if (File::exists($imagePath)) {
                File::delete($imagePath);
                // Log::info("Image deleted at: $imagePath");
            } else {
                // Log::warning("Image not found at: $imagePath");
            }
        } else {
            // Log::warning("No image field for product: $id");
        }
    
        $hero->delete();
        // Log::info("Product deleted: $id");
    
        return response()->json(['success' => 'Product deleted successfully']);
    }


    public function toggleStatus(Request $request, $id)
    {
        $status = $request->status;
    
        // First, deactivate all heroes
        heros::where('id', '!=', $id)->update(['status' => 0]);
    
        // Then activate the selected one
        $hero = heros::findOrFail($id);
        $hero->status = $status;
        $hero->save();
    
        return response()->json([
            'message' => $status ? 'This hero is now active. Others deactivated.' : 'Hero is now inactive.'
        ]);
    }
    
       
}





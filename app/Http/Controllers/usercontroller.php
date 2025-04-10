<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\StudentModel;
use Illuminate\Http\Request;



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
     public function getusercontact2(){
        return view('contact2');
     }

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

   //add product model
   public function addproduct(Request $request){
      $request->validate([
         'name'=>"required|max:255|string",
         'price'=>"required|max:255|string",
        

      ]);
      product::create([
         'name'=>$request->name,
         'price'=>$request->price,
        
         

      ]);
       return redirect()->back()->with('status','Inserted');
     }





     public function showdata2(){
      
      $products=product::get();
      // dd($products);

      return view('contact2',["data"=>$products]);
   }

   public function editeajax(int $id){
      
      $product=product::findOrFail($id);
      return view('addproduct_modal',["data"=>$product]);
   }

   public function deleteajax(int $id){
      
      $del=product::findOrFail($id);
      $del->delete();    
      return response()->json(['status'=>true]); 
    }

     
      
  
}

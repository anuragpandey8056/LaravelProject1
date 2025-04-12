<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\StudentModel;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervension\Image\Facades\Image;
use Intervension\Image\Facades\File;

use Illuminate\support\facades\storage;
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
      $image = $request->file('image');
        $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
        $image->move('img',$imageName);
     



        $tbl = new product;
        $tbl->name=$request->name;
        $tbl->price=$request->price;
        $tbl->image=$imageName;


        if(empty($formData['id'])||($formData['id']=="")){
            $tbl->save();
            return response()->json(['status' => 'success', 'message' => 'Product Added']);
        }
      else{
        $tbl=product::find($formData['id']);
        if (!$tbl) {
            return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
        }
        $tbl->name=$request->name;
        $tbl->price=$request->price;
        $tbl->image=$imageName;
        
        $tbl->update();
        return response()->json(['status' => 'success', 'message' => 'Product Updated']);
   }

  }


   public function fetchdata(){
      return product::orderBy('id','desc')->get();
   }
   

   public function editdata(Request $req){
      return product::find($req->id);   
   }

   public function deletedata(Request $req){
      $product=product::find($req->id);
      // product::where('id',$req->id)->delete();
      if($product){
         $imagepath=public_path('img',$product->image);
         if(file::exits($imagepath)){
            file::delete($imagepath);
         }
         $product->delete();

         return response()->json("data deleted sucessfully");


      }else{
         return response()->json("item not deleted ");

      }

      echo "data delted succesfully";
      
    }

     
      
  
}

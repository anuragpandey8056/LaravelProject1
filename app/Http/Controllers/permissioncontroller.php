<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class permissioncontroller extends Controller
{
    //
    public function index(){
        $permissions=Permission::get();
        return view('role-permission.permission.index',compact('permissions'));
    }
    public function create(){
        return view('role-permission.permission.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:permissions,name'
            ]
            

          
        ]);

        Permission::create([
            'name'=>$request->name
                

        ]);
        return redirect('permission')->with('status','permission created succesfully');
        
    }
    public function edit(Permission $permission){
       
       
      
        return view('role-permission.permission.edit',['permission'=>$permission]);
        
    }

    public function update(Request $request,Permission $permission){
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
          
        ]);
        $permission->update([
            'name'=>$request->name
                

        ]);
        return redirect('permission')->with('status','permission Updated  succesfully');
        
    }
    public function delete($permissionId){
        $permission=Permission::find($permissionId);
        $permission->delete();
        return redirect('permission')->with('status','permission deleteed  succesfully');
        
    }
}

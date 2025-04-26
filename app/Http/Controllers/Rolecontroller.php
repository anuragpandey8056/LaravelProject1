<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Rolecontroller extends Controller
{
    public function index(){
        $roles=Role::get();
        return view('role-permission.role.index',compact('roles'));
    }
    public function create(){
        return view('role-permission.role.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name'
            ]
            

          
        ]);

        Role::create([
            'name'=>$request->name
                

        ]);
        return redirect('roles')->with('status','role created succesfully');
        
    }
    public function edit(Role $role){
       
       
      
        return view('role-permission.role.edit',['role'=>$role]);
        
    }

    public function update(Request $request,Role $role){
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
          
        ]);
        $role->update([
            'name'=>$request->name
                

        ]);
        return redirect('roles')->with('status','role Updated  succesfully');
        
    }
    public function delete($roleId){
        $role=Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status','role deleteed  succesfully');
        
    }

    public function addPermissionToRole($roleId){
        $permissions=Permission::get();
        $role=Role::findOrFail($roleId);
        $rolepermission = DB::table('role_has_permissions')
        ->where('role_id', $role->id)
        ->pluck('permission_id', 'permission_id')
        ->toArray();
    
        return view ('role-permission.role.add-permissions',compact('role','permissions','rolepermission'));

    }

    public function givePermissionToRole( Request $request, $roleId){
        $request->validate([
           'permission'=>'required'
          
        ]);
        $role=Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status','Permission added to role');
    }

}

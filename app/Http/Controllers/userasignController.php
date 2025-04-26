<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class userasignController extends Controller
{
    //
public function index(){
    $users=User::get();
    return view('role-permission.user.index',compact('users'));
}

public function create(){
    $roles=Role::pluck('name','name')->all();
    return view('role-permission.user.create',compact('roles'));
}

public function store(Request $request){

     $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|max:20',
        'roles' => 'required'
    ]);
    //    Log::error("Product not found with ");

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->syncRoles($request->roles);

    return redirect('users')->with('status', 'User created successfully with roles');

   
}

public function edit(User $user) {
        
        $roles=Role::pluck('name','name')->all();
        $userRoles=$user->roles->pluck('name','name')->all();
         return view('role-permission.user.edit',compact('user','roles','userRoles'));
}

public function update(User $user, Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8|max:20',
        'roles' => 'required'
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    if (!empty($request->password)) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);
    $user->syncRoles($request->roles);

    return redirect('users')->with('status', 'User updated with roles');
}

public function delete($userId){
    $user=User::find($userId);
    $user->delete();
    return redirect('users')->with('status','users deleteed with roles  succesfully');
}










}

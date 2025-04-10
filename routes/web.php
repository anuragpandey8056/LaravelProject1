<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[usercontroller::class,'getuser'])->name('/');
Route::get('contact/',[usercontroller::class,'getusercontact'])->name('contact');
Route::get('service/',[usercontroller::class,'getuserservice'])->name('service');
Route::get('about/',[usercontroller::class,'getuserabout'])->name('about');
Route::get('/contact2',[usercontroller::class,'getusercontact2'])->name('contact2');
Route::post('/adduser',[usercontroller::class,'getadduser'])->name('adduser');
Route::get('showdata',[usercontroller::class,'getshowdata'])->name('showdata');
Route::get('{id}/delete',[usercontroller::class,'getdelete']);
Route::get('{id}/edit',[usercontroller::class,'getedit']);
Route::post('{id}/update',[usercontroller::class,'getupdate']);
Route::post('/addproduct',[usercontroller::class,'addproduct'])->name('addproduct');
Route::get('/contact2',[usercontroller::class,'showdata2'])->name('showdata2');
Route::get('{id}/editajax',[usercontroller::class,'editeajax'])->name('editajax');
Route::delete('/deleteajax/{id}',[usercontroller::class,'deleteajax']);














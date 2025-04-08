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




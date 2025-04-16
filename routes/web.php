<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\usercontroller;
use App\Http\Controllers\admincontroller;


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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/',[usercontroller::class,'getuser'])->name('/');
Route::get('contact/',[usercontroller::class,'getusercontact'])->name('contact');
Route::get('service/',[usercontroller::class,'getuserservice'])->name('service');
Route::get('about/',[usercontroller::class,'getuserabout'])->name('about');
Route::post('/adduser',[usercontroller::class,'getadduser'])->name('adduser');
Route::get('showdata',[usercontroller::class,'getshowdata'])->name('showdata');
Route::get('{id}/delete',[usercontroller::class,'getdelete']);
Route::get('{id}/edit',[usercontroller::class,'getedit']);
Route::post('{id}/update',[usercontroller::class,'getupdate']);

Route::get('/contact2',[usercontroller::class,'getusercontact2'])->name('contact2');


// //ajax crud
Route::prefix('products')->group(function(){
    Route::post('/save-item', [usercontroller::class, 'store'])->name('product.store');
    Route::get('/{id}/edit', [usercontroller::class, 'edit'])->name('product.edit');
    Route::post('/{id}/update', [usercontroller::class, 'update'])->name('product.update');
    Route::delete('/delete/{id}', [usercontroller::class, 'delete'])->name('product.delete');
});


//admin_dashboard

Route::get('/dashboard', [admincontroller::class, 'adminindex'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/viewproduct', [admincontroller::class, 'adminviewproduct'])->name('viewproduct');
























// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


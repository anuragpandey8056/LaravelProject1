<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\shopcontroller;

use App\Http\Controllers\SongController;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\SingerController;
use App\Http\Controllers\ProfileController;


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
// Route::get('/',[usercontroller::class,'getusercontact'])->name('contact');



Route::get('/',[usercontroller::class,'getuser'])->name('/');
Route::get('contact/',[usercontroller::class,'getusercontact'])->name('contact');
Route::get('service/',[usercontroller::class,'getuserservice'])->name('service');
Route::get('about/',[usercontroller::class,'getuserabout'])->name('about');
Route::post('/adduser',[usercontroller::class,'getadduser'])->name('adduser');
Route::get('showdata',[usercontroller::class,'getshowdata'])->name('showdata');
Route::get('{id}/delete',[usercontroller::class,'getdelete']);
Route::get('{id}/edit',[usercontroller::class,'getedit']);
Route::post('{id}/update',[usercontroller::class,'getupdate']);

Route::get('/contact2',[usercontroller::class,'getusercontact2'])->name('contact2');


Route::get('fashion1',[usercontroller::class,'fashion']);
Route::get('electronics1',[usercontroller::class,'electronics']);
Route::get('beauty1',[usercontroller::class,'beauty']);
Route::get('grocery1',[usercontroller::class,'grocery']);
Route::get('Stationary1',[usercontroller::class,'Stationary']);

Route::get('/shop',[shopcontroller::class,'shop']);





// //ajax crud
Route::prefix('products')->group(function(){
    Route::post('/save-item', [usercontroller::class, 'store'])->name('product.store');
    Route::get('/{id}/edit', [usercontroller::class, 'edit'])->name('product.edit');
    Route::post('/{id}/update', [usercontroller::class, 'update'])->name('product.update');
    Route::delete('/delete/{id}', [usercontroller::class, 'delete'])->name('product.delete');
});


//admin_dashboard

// Route::get('/dashboard', [admincontroller::class, 'adminindex'])->middleware(['auth', 'verified','PreventBackHistory'])->name('dashboard');
Route::middleware(['auth', 'verified', 'PreventBackHistory'])->group(function () {
    Route::get('/dashboard', [admincontroller::class, 'adminindex'])->name('dashboard');
    Route::get('/viewproduct', [admincontroller::class, 'adminviewproduct'])->name('viewproduct');
    Route::get('/addhero', [admincontroller::class, 'addadminhero']);


});

//mamy to many relation 
Route::get('/add-song', [SongController::class, 'add_song']);
Route::get('/add-singer', [SingerController::class, 'add_singer']);
Route::get('/show-song/{id}', [SongController::class, 'show_song']);
Route::get('/show-singer/{id}', [SingerController::class, 'show_singer']);


Route::prefix('hero')->group(function(){
    Route::post('/save-item', [admincontroller::class, 'store'])->name('hero.store');
    Route::get('/{id}/edit',[admincontroller::class, 'edit'])->name('hero.edit');
    Route::post('/{id}/update', [admincontroller::class, 'update'])->name('hero.update');
    Route::delete('/delete/{id}', [admincontroller::class, 'delete'])->name('hero.delete');
    Route::post('/toggle-status/{id}', [admincontroller::class, 'toggleStatus'])->name('hero.toggle');

});





























// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


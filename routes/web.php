<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rolecontroller;

use App\Http\Controllers\shopcontroller;
use App\Http\Controllers\SongController;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\SingerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\razorpaycontroller;
use App\Http\Controllers\userasignController;
use App\Http\Controllers\permissioncontroller;
use App\Http\Controllers\SubscriptionController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/


// Route::resource('permission',[permissioncontroller::class,'index']);
//Permissions

Route::group(['middleware'=>'role:super-admin'],function(){
Route::resource('permission',permissioncontroller::class);
Route::get('permission/{permissionId}/delete',[permissioncontroller::class,'delete']);

// roles
Route::resource('roles',Rolecontroller::class);
Route::get('roles/{roleId}/delete',[Rolecontroller::class,'delete']);
Route::get('roles/{roleId}/give-permissions',[Rolecontroller::class,'addPermissionToRole']);
Route::put('roles/{roleId}/give-permissions',[Rolecontroller::class,'givePermissionToRole']);



Route::resource('users',userasignController::class);
Route::get('users/{userId}/delete',[userasignController::class,'delete']);

});


Route::get('/subscription',[SubscriptionController::class,'getsubscription']);


Route::get('/',[SubscriptionController::class,'getsubscription'])->name('/getsubscription');

Route::get('/index',[usercontroller::class,'getuser'])->name('/index');
Route::get('contact/',[usercontroller::class,'getusercontact'])->name('contact');
Route::get('service/',[usercontroller::class,'getuserservice'])->name('service');
Route::get('/about',[usercontroller::class,'getuserabout'])->name('about');
Route::post('/adduser',[usercontroller::class,'getadduser'])->name('adduser');
Route::get('showdata',[usercontroller::class,'getshowdata'])->name('showdata');
Route::get('/plans',[usercontroller::class,'getshowplan'])->name('plans');

Route::get('{id}/delete',[usercontroller::class,'getdelete']);
Route::get('{id}/edit',[usercontroller::class,'getedit']);
Route::post('{id}/update',[usercontroller::class,'getupdate']);

Route::get('/contact2',[usercontroller::class,'getusercontact2'])->name('contact2');


Route::get('fashion1',[usercontroller::class,'fashion']);
Route::get('electronics1',[usercontroller::class,'electronics']);
Route::get('beauty1',[usercontroller::class,'beauty']);
Route::get('grocery1',[usercontroller::class,'grocery']);
Route::get('Stationary1',[usercontroller::class,'Stationary']);
Route::get('/add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('addcart');

// Route for viewing cart
Route::get('/cart', [ShopController::class, 'viewCart'])->name('cart');


Route::post('/update-cart/{id}', [ShopController::class, 'updateCart'])->name('update.cart');
Route::get('/remove-cart/{id}', [ShopController::class, 'removeCart'])->name('remove.cart');




// Razorpay Payment Routes
Route::post('/razorpay-payment', [razorpaycontroller::class, 'payment'])->name('razorpay.payment');

Route::get('/order-success/{id}', [razorpaycontroller::class, 'orderSuccess'])->name('order.success');





//subscription payemtn
Route::post('/razorpay/create-order', [razorpaycontroller::class, 'createOrder'])->name('razorpay.create.order');
Route::get('/tenant/success', [TenantController::class, 'success'])->name('tenant.success');





// You should also add a route for checkout
Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');

// And possibly add a route for your shop page if it doesn't exist yet
Route::get('/shop', [ShopController::class, 'index'])->name('shop');



Route::get('/shop',[shopcontroller::class,'shop']);
Route::get('/filter-products', [shopcontroller::class, 'filterProducts'])->name('filter.products');






// //ajax crud
// Route::prefix('products')->group(function(){
//     Route::post('/save-item', [usercontroller::class, 'store'])->name('product.store');
//     Route::get('/{id}/edit', [usercontroller::class, 'edit'])->name('product.edit');
//     Route::post('/{id}/update', [usercontroller::class, 'update'])->name('product.update');
//     Route::delete('/delete/{id}', [usercontroller::class, 'delete'])->name('product.delete');
// });


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



Route::resource('tanent',TenantController::class)->middleware(['auth', 'verified']);
Route::post('tanent/store',[TenantController::class,'store'])->name('tenant.store');





Route::get('/subscriptiondashboard', [SubscriptionController::class, 'subscriptiondashboard']);
Route::get('/subscriptiondashboardplan', [SubscriptionController::class, 'subscriptiondashboardplan']);


require __DIR__.'/auth.php';


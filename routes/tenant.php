<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Tenantroutes;
use App\Http\Controllers\Rolecontroller;
use App\Http\Controllers\shopcontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\razorpaycontroller;
use App\Http\Controllers\userasignController;
use App\Http\Controllers\permissioncontroller;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    'tenant.active',
])->group(function () {
    Route::get('/', [Tenantroutes::class, 'default'])->name('default');
    Route::get('/index',[usercontroller::class,'getuser'])->name('/index');
Route::get('contact/',[usercontroller::class,'getusercontact']);
Route::get('service/',[usercontroller::class,'getuserservice']);
Route::get('/about',[usercontroller::class,'getuserabout']);
Route::post('/adduser',[usercontroller::class,'getadduser']);
Route::get('showdata',[usercontroller::class,'getshowdata']);
Route::get('/plans',[usercontroller::class,'getshowplan']);




Route::get('fashion1',[usercontroller::class,'fashion']);
Route::get('electronics1',[usercontroller::class,'electronics']);
Route::get('beauty1',[usercontroller::class,'beauty']);
Route::get('grocery1',[usercontroller::class,'grocery']);
Route::get('Stationary1',[usercontroller::class,'Stationary']);

Route::get('/add-to-cart/{id}', [shopcontroller::class, 'addToCart']);
Route::get('/cart', [shopcontroller::class, 'viewCart'])->name('cart');


Route::post('/update-cart/{id}', [shopcontroller::class, 'updateCart'])->name('update.cart');
Route::get('/remove-cart/{id}', [shopcontroller::class, 'removeCart'])->name('remove.cart');
//    Route::get('login',function(){
//     return view('app.auth.login');
//    });



// You should also add a route for checkout
Route::get('/checkout', [shopcontroller::class, 'checkout'])->name('checkout');

// And possibly add a route for your shop page if it doesn't exist yet
Route::get('/shop', [shopcontroller::class, 'index'])->name('shop');



Route::get('/shop',[shopcontroller::class,'shop']);
Route::get('/filter-products', [shopcontroller::class, 'filterProducts'])->name('filter.products');


// Razorpay Payment Routes
Route::post('/razorpay-payment', [razorpaycontroller::class, 'payment'])->name('razorpay.payment');

Route::get('/order-success/{id}', [razorpaycontroller::class, 'orderSuccess'])->name('order.success');





//subscription payemtn
Route::post('/razorpay/create-order', [razorpaycontroller::class, 'createOrder'])->name('razorpay.create.order');
Route::get('/tenant/success', [TenantController::class, 'success'])->name('tenant.success');

Route::get('/dashboard', [Tenantroutes::class, 'adminindex2']);
 
  
Route::prefix('products')->group(function(){
    Route::post('/save-item', [Tenantroutes::class, 'store']);
    Route::get('/{id}/edit', [Tenantroutes::class, 'edit']);
    Route::post('/{id}/update', [Tenantroutes::class, 'update']);
    Route::delete('/delete/{id}', [Tenantroutes::class, 'delete']);
});



    Route::get('/dashboard', [admincontroller::class, 'adminindex']);
    Route::get('/viewproduct', [admincontroller::class, 'adminviewproduct']);
    Route::get('/addhero', [admincontroller::class, 'addadminhero']);









    Route::post('herosaveitem', [admincontroller::class, 'store']);
    Route::get('{id}/edit',[admincontroller::class, 'edit']);
    Route::post('{id}/update', [admincontroller::class, 'update']);
    Route::delete('delete/{id}', [admincontroller::class, 'delete']);
    Route::post('toggle-status/{id}', [admincontroller::class, 'toggleStatus']);



Route::resource('permission',permissioncontroller::class);
Route::get('permission/{permissionId}/delete',[permissioncontroller::class,'delete']);

// roles
Route::resource('roles',Rolecontroller::class);
Route::get('roles/{roleId}/delete',[Rolecontroller::class,'delete']);
Route::get('roles/{roleId}/give-permissions',[Rolecontroller::class,'addPermissionToRole']);
Route::put('roles/{roleId}/give-permissions',[Rolecontroller::class,'givePermissionToRole']);



Route::resource('users',userasignController::class);
Route::get('users/{userId}/delete',[userasignController::class,'delete']);

   




Route::get('/addblog', [AdminController::class, 'adminBlog']);
Route::post('/blogs', [AdminController::class, 'storeBlog']);
Route::get('/addblog/{id}', [AdminController::class, 'editBlog']);
Route::put('/blogs/{id}', [AdminController::class, 'updateBlog']);
Route::get('/blogs/{id}/delete', [AdminController::class, 'destroyBlog']);










require __DIR__.'/user-auth.php';

   
   
    

});

<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Tenantroutes;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\TenantController;
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


//    Route::get('login',function(){
//     return view('app.auth.login');
//    });

Route::get('/dashboard', [Tenantroutes::class, 'adminindex2']);
 
   


Route::middleware(['auth', 'verified', 'PreventBackHistory'])->group(function () {
    Route::get('/dashboard', [admincontroller::class, 'adminindex']);
    Route::get('/viewproduct', [admincontroller::class, 'adminviewproduct']);
    Route::get('/addhero', [admincontroller::class, 'addadminhero']);






});

   require __DIR__.'/user-auth.php';

   
   
    

});

<?php

use App\Http\Controllers\app\Auth\AuthenticatedSessionController;
use App\Http\Controllers\app\Auth\ConfirmablePasswordController;
use App\Http\Controllers\app\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\app\Auth\EmailVerificationPromptController;
use App\Http\Controllers\app\Auth\NewPasswordController;
use App\Http\Controllers\app\Auth\PasswordController;
use App\Http\Controllers\app\Auth\PasswordResetLinkController;
use App\Http\Controllers\app\Auth\RegisteredUserController;
use App\Http\Controllers\app\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('tenantregister', [RegisteredUserController::class, 'create'])
                ->name('tenantregister');

    Route::post('tenantregister', [RegisteredUserController::class, 'store']);

    Route::get('tenantlogin', [AuthenticatedSessionController::class, 'create'])
                ->name('tenantlogin');

    Route::post('tenantlogin', [AuthenticatedSessionController::class, 'store']);

    Route::get('tenantforgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('tenantforgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('tenantreset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('tenantreset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('tenantverify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('tenantverify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('tenantemail/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('tenantconfirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('tenantconfirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('tenantpassword', [PasswordController::class, 'update'])->name('password.update');

    Route::post('tenantlogout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('tenantlogout');
});

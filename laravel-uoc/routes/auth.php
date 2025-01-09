<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/producto3/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/producto3/register', [RegisteredUserController::class, 'storeN']);

    Route::get('/producto3/login', [AuthenticatedSessionController::class, 'createN'])
        ->name('login');

    Route::post('/producto3/login', [AuthenticatedSessionController::class, 'storeN']);

    Route::get('/producto3/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('/producto3/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('/producto3/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/producto3/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/producto3/verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('/producto3/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/producto3/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('/producto3/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('/producto3/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('/producto3/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('/producto3/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

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
use App\Http\Controllers\LoginInfoController;

/**
 * 認証　ログイン
 */
Route::middleware('guest')->group(function () {

    Route::get('login', [LoginInfoController::class, 'create'])
                ->name('login');

    Route::post('login', [LoginInfoController::class, 'store']);

});

/**
 * 認証　ログアウト
 */
Route::middleware('auth')->group(function () {
    
    Route::post('logout', [LoginInfoController::class, 'destroy'])
                ->name('logout');
});

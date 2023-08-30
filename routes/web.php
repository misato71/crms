<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LeadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 認証
 */
Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

/**
 * 顧客情報
 */
Route::resource('customers', CustomerController::class)
->middleware(['auth', 'verified']);

/**
 * リード情報
 */
Route::resource('leads', LeadController::class)
->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';

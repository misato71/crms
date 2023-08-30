<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LeadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 * 顧客情報　新規登録
 */
Route::middleware('auth:sanctum')
->post('/customers', [CustomerController::class, 'store']);

/**
 * 顧客情報　編集
 */
Route::middleware('auth:sanctum')
->put('/customers/{customer}', [CustomerController::class, 'update']);

/**
 * リード情報　新規登録
 */
Route::middleware('auth:sanctum')
->post('/leads', [LeadController::class, 'store']);

/**
 * リード情報　編集
 */
Route::middleware('auth:sanctum')
->put('/leads/{lead}', [LeadController::class, 'update']);



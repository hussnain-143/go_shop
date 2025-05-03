<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [AuthController::class,'usergetApi'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class,'createUserApi']);
Route::post('/login', [AuthController::class,'loginApi']);
Route::post('/update_user', [AuthController::class,'userupdateApi'])->middleware('auth:sanctum');
Route::post('/logout', function(Request $request){

    $request->user()->tokens()->delete();
    return response()->json(['message' => 'Logged out'], 200);
})->middleware('auth:sanctum');


/**
 * Home Page API
 */

Route::get('/homepage', [HomeController::class,'HomeSetupApi']);
Route::get('/homepage_category', [HomeController::class,'HomeCategoryApi']);

/**
 * Category Page API
 */
Route::post('/category_data', [HomeController::class,'CategoryApi']);



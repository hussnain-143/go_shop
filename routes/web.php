<?php
use App\Http\Controllers\Auth\AuthController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return redirect()->route('admin.dashboard');
    return view('index');
});

Route::get('/login', function () {
    return view('auth.signin');
})->name('login');
Route::post('login_user', [AuthController::class,'loginUser'])->name('user.login');

Route::get('/logout',function(){
    Auth::logout();
    return view('auth.signin');
})->name('user.logout');

Route::get('/api_docs',function(){
    return view('api-docs');
});

// ✅ Include Admin Routes
require __DIR__.'/admin.php'; 

// Catch-all must come last
Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
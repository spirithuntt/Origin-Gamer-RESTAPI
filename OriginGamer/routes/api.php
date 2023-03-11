<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

// ressource product and category
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);

// endpoints for user ['get all users', 'get specific user', 'update information's' , 'delete account']
// second line (37) : this endpoint for update password
Route::apiResource('user', UserController::class)->except(['store']);
Route::match(['put', 'patch'],'user/pass/{user}', [UserController::class, 'update_password'])->name('user.update_pass');

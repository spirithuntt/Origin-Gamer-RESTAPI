<?php


use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('forgotPassword', 'forgotPassword');
    Route::post('resetPassword', 'resetPassword')->name('password.reset');
});

// ressource product and category
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);

// filter product by category
Route::get('products/category/{category_id}', [ProductController::class, 'filterByCategory']);

// endpoints for user ['get all users', 'get specific user', 'update information's' , 'delete account']
// second line (37) : this endpoint for update password
Route::apiResource('user', UserController::class)->except(['store']);
Route::match(['put', 'patch'],'user/pass/{user}', [UserController::class, 'update_password'])->name('user.update_pass');

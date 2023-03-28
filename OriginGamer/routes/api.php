<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;

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
    Route::post('forgotPassword', 'forgotPassword');
    Route::post('resetPassword', 'resetPassword')->name('password.reset');
});

// ressource product and category
Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('roles/detail', [RolesController::class, 'indexWithPermissions']);
    Route::put('/roles/{role}/permissions/{permission}', [RolesController::class, 'updatePermission']);
    Route::put('/users/{user}/role/{role}', [RolesController::class, 'updateRole']);
    Route::apiResource('roles', RolesController::class);
    Route::apiResource('permissions', PermissionsController::class);
});

// ressource user
Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('users', UserController::class);
});

// filter product by category
Route::get('products/category/{category_id}', [ProductController::class, 'filterByCategory']);

//roles






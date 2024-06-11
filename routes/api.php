<?php

// use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');
    });


    Route::controller(ProductController::class)->group(function () {
        Route::post('/products', 'create')->name('products.create');
        Route::post('/products/{id}', 'update')->name('products.update');
        Route::delete('/products/{id}', 'delete')->name('products.delete');
        Route::get('/products/{id}', 'show')->name('products.show');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::post('/categories', 'create')->name('categories.create');
        Route::post('/categories/{id}', 'update')->name('categories.update');
        Route::delete('/categories/{id}', 'delete')->name('categories.delete');
        Route::get('/categories/{id}', 'show')->name('categories.show');
    });
});

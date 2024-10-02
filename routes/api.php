<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);



Route::middleware('auth:sanctum')->group(function() {
    Route::post('/addproducts', [ProductController::class, 'addProduct']);
    Route::get('/getproducts', [ProductController::class, 'getproducts']);
    Route::post('/placeorders', [OrderController::class, 'placeOrder']);
    Route::get('/fetchorders', [OrderController::class, 'getorders']);
    Route::post('/update/orders/{id}', [OrderController::class, 'updateOrderStatus']);


});


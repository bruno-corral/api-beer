<?php

use App\Http\Controllers\BeersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Beer
Route::get('beers', [BeersController::class, 'index']);
Route::post('beers/add', [BeersController::class, 'create']);
Route::put('beers/{id}', [BeersController::class, 'update']);
Route::delete('beers/{id}', [BeersController::class, 'delete']);

// Product
Route::get('products', [ProductsController::class, 'index']);
Route::post('products/add', [ProductsController::class, 'create']);
Route::put('products/{id}', [ProductsController::class, 'update']);
Route::delete('products/{id}', [ProductsController::class, 'delete']);

// User
Route::post('user/signup', [UserController::class, 'signup']);
Route::post('user/signin', [UserController::class, 'signin']);

Route::post('user/validateToken', [UserController::class, 'validateToken']);

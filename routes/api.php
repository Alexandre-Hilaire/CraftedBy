<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CrafterController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\PmodelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* 
 * apiResssource créer automatiquement les routes :
 * GET / POST : api/products
 * GET / PUT / PATCH / DELETE api/products/{product}
*/
Route::apiResource('products',ProductController::class);

Route::apiResource('crafters', CrafterController::class);

Route::apiResource('images', ImageController::class);

Route::apiResource('addresses',AddressController::class);

Route::apiResource('pmodels', PmodelController::class);

Route::apiResource('categories', CategoryController::class);

Route::apiResource('materials', MaterialController::class);

Route::apiResource('orders', OrderController::class);

Route::apiResource('users', UserController::class);

// * Search filters routes

Route::get('/products/search/{categoryId}', [ProductController::class, 'searchByCatergories']);

Route::get('/orders/search/{userID}',[OrderController::class, 'searchByUser']);
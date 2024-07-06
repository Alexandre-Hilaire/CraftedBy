<?php

use App\Http\Controllers\AdresseApi;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CrafterController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\PmodelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MindeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StripeController;

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
 * apiResssource create automaticly routes :
 * GET / POST / PUT|PATCH / DELETE
*/

// * Protected routes, you must be authentitcate
Route::middleware(['auth:sanctum'])->group(function () {

    // * Adresses
    Route::apiResource('addresses', AddressController::class);

    Route::get('/addresses/search/{userId}', [AddressController::class, 'getUserAddresses']);

    // * orders

    Route::apiResource('orders', OrderController::class);
    
    Route::get('/orders/search/{userID}', [OrderController::class, 'searchByUser']);

    // * users

    Route::apiResource('users', UserController::class);

    Route::get('/users/role/{user}', [UserController::class, 'getUserRole']);

    Route::get('/users/crafters/{user}', [UserController::class, 'getUserCrafters']);

    route::get('/users/products/{user}',[UserController::class, 'getUserProducts']);

    // * crafters

    Route::apiResource('crafters', CrafterController::class);

    // * images

    Route::apiResource('images', ImageController::class);

    // * products

    Route::apiResource('products', ProductController::class);

     // * Categories

    Route::apiResource('categories', CategoryController::class);

    // * materials

    Route::apiResource('materials', MaterialController::class);

    // * pModels

    Route::apiResource('pmodels', PmodelController::class);


    // * Mindee API
    Route::post('/parse-file', [MindeeController::class, 'parseFile']);

    // * Stripe
    Route::post('payment/initiate', [StripeController::class, 'initiatePayment']);
    Route::post('payment/complete', [StripeController::class, 'completePayment']);
    Route::post('payment/failure', [StripeController::class, 'failPayment']);

    // * Invoices
    Route::post('invoice', [InvoicesController::class, 'createInvoice']);
});

// * Unprotected routes

    // * products 
Route::apiResource('products', ProductController::class)->only(["index", "show", "searchByCatergories"]);
Route::get('/products/search/{categoryId}', [ProductController::class, 'searchByCatergories']);

    // * crafters
Route::apiResource('crafters', CrafterController::class)->only(["index", "show"]);

    // * images
Route::apiResource('images', ImageController::class)->only(["index", "show"]);

    // * categories
Route::apiResource('categories', CategoryController::class)->only(["index", "show"]);

    // * materials
Route::apiResource('materials', MaterialController::class)->only(["index", "show"]);

    // * pmodels
Route::apiResource('pmodels', PmodelController::class)->only(["index", "show"]);

// * AdressesAPI
Route::post('/searchAdress', [AdresseApi::class, 'searchAdress']);

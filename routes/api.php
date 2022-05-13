<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductControllerAPI;
use App\Http\Controllers\API\CategoryControllerAPI;

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


# category api resource
Route::group(['prefix' => '/v1/admin'], function() {
    Route::get('/categories',[CategoryControllerAPI::class, 'index']);
    Route::post('/category/create',[CategoryControllerAPI::class, 'store']);
    Route::get('/category/{id}',[CategoryControllerAPI::class, 'show']);
    Route::post('/category/{id}/update',[CategoryControllerAPI::class, 'update']);
    Route::delete('/category/{id}/delete',[CategoryControllerAPI::class, 'destroy']);


    # ProductControllerAPI
    Route::get('/products',[ProductControllerAPI::class, 'index']);
    Route::get('/product/{id}',[ProductControllerAPI::class, 'show']);
    Route::any('/product/{id}/details/',[ProductControllerAPI::class, 'show'])->name('product.detail');
});

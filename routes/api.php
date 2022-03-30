<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsersAPIController;
use App\Http\Controllers\API\Product_api_controller;

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
require __DIR__.'/auth.php'; #user this class for laravel laratrust Route
# Auth::routes(); user this class for laravel ui Route
Route::group(['prefix' => 'tim/admin/'], function() {
    # product route
    Route::get('v1/products', [Product_api_controller::class, 'index'])->name('product.api.index');
    Route::get('v1/product/{id}',[Product_api_controller::class, 'show']);
    Route::get('v1/product/{id}/delete',[Product_api_controller::class, 'destroy']);
    Route::get('v1/product/{id}/edit',[Product_api_controller::class, 'edit']);
    Route::get('v1/product/{id}/update',[Product_api_controller::class, 'update']);

    #user route
    // Route::resource('v1/users', [UsersAPIController::class, 'index'])->name('uses.index');
    Route::get('v1/users', [UsersAPIController::class, 'index'])->name('uses.index');
});



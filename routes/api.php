<?php

use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//Admin Routes
Route::middleware(['auth:sanctum', 'user-access:admin'])->group(function () {
    Route::get('/admin/menu', [MenuController::class, 'index']);
    Route::get('/admin/menu/{id}', [MenuController::class, 'show']);
    Route::post('/admin/menu/store', [MenuController::class, 'store']);
    Route::post('/admin/menu/update/{id}', [MenuController::class, 'update']);
    Route::delete('/admin/menu/delete/{id}', [MenuController::class, 'destroy']);
});


// Order Routes

    Route::get('/orders', [OrderController::class, 'getAllOrders'])->name('orders');
    Route::get('/order/{id}', [OrderController::class, 'getOrderById'])->name('order');
    Route::post('/order/store', [OrderController::class, 'createOrder'])->name('order.store');
    Route::get('/order/items/{id}', [OrderController::class, 'showOrderItems'])->name('order.items');
    Route::post('/order/add-item', [OrderController::class, 'addOrderItem'])->name('order.add-item');
    Route::post('/order/remove-item', [OrderController::class, 'removeOrderItem'])->name('order.remove-item');
    Route::post('/order/update/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/delete/{id}', [OrderController::class, 'destroy'])->name('order.delete');



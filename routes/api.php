<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;
use App\Models\Order;

Route::get('/test-orders', function () {
    $orders = Order::with('products')->get();
    return response()->json($orders);
});


Route::get('/books', [BookController::class, 'index']);

Route::post('/books/create', [BookController::class, 'store']);

Route::get('/books/{id}', [BookController::class, 'show']);

Route::put('/books/update/{id}', [BookController::class, 'update']);

Route::delete('/books/delete/{id}', [BookController::class, 'destroy']);



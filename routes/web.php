<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('products.index');
});


Route::resource('products', ProductController::class);


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return 'Admin Only';
})->middleware('admin');



Route::get('/loginekatalog', function () {
    return view('ekatalog.login');
});

Route::get('/nakerekatalog', function () {
    return view('ekatalog.index');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

Route::get('/', function (){
    return view('welcome');
});

Route::get('/aprendices', function (){
    return view("aprendices");
});

Route::get('/consultar',function(){
    $user = new App\Models\User();
    //SELECT * FROM users
    return dd($user->all());
});

Route::get('/insertar',function(){
    $user = new App\Models\User();
    $user-> email = 'otroemail@mail.com';
    $user-> name = 'Otro Ejemplo';
    $user-> password = 'mypassword';
    $user-> save();
    // Insert into users (email, name, password) values ('?,?,?')
    return dd($user);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.list');

Route::get('/checkout', function(){
    return view('checkout');
});

Route::post('/orders', [OrderController::class, 'store']);
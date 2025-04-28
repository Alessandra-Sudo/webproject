<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HelpRequestController;

Route::get('/', [RouteController::class, 'toHome'])->name('home');

Route::get('/signin', [RouteController::class, 'toSignIn'])->name('signin');

Route::post('/signin', [AuthenticationController::class, 'SignInUser']);

Route::get('/signup', [RouteController::class, 'toSignUp'])->name('signup');

Route::post('/signup', [AuthenticationController::class, 'SignUpUser']);

Route::post('/signout', [AuthenticationController::class, 'SignOutUser'])->name('signout');

Route::get('/cart', [RouteController::class, 'toCart'])->name('cart');

Route::get('/products/{id}', [RouteController::class, 'viewProduct']);

Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

Route::get('/help', [RouteController::class, 'helpCenter'])->name('helpCenter');

Route::post('/help', [HelpRequestController::class, 'createHelpRequest']);

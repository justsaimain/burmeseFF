<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/{any?}', App\Http\Controllers\PagesController::class);

Route::post('auth/social/{provider}', [AuthController::class,'social']);

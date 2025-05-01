<?php

use App\Http\Controllers\Users;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::post('/create-account', [Users::class, 'createAccount'])->name('create-account');


Route::get('/dashboard',function (){
    return view('dashboard');
})->name('dashboard')->middleware('auth');


Route::post('/authenticate-user', [Users::class, 'authenticate'])->name('authenticate-user');


Route::get('/login',function (){
    return view('login');
})->name('login');





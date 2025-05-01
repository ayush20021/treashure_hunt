<?php

use App\Http\Controllers\Users;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');


Route::post('/create-account', [Users::class, 'createAccount'])->name('create-account');


Route::get('/dashboard',function (){
    return view('dashboard');
})->name('dashboard')->middleware('auth');


Route::post('/authenticate-user', [Users::class, 'authenticate'])->name('authenticate-user');


Route::get('/login',function (){
    return view('login');
})->name('login');


Route::get('/user-profile/{id}',[Users::class,'userProfile'])->name('user-profile')->middleware('auth');




Route::post('profile-update-picture',[Users::class,'update_profile_picture'])->name('profile-update-picture')->middleware('auth');

Route::post('update_profile_details',[Users::class,'update_profile_details'])->name('update_profile_details')->middleware('auth');





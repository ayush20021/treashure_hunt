<?php

use App\Http\Controllers\Users;
use App\Http\Controllers\Treasures;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;



Route::get('/migrate', function () {
    Artisan::call('migrate', [
        '--force' => true // Avoids confirmation prompt in production
    ]);

    return 'Migration executed successfully!';
});

Route::get('/storage-link', function() {
    if(file_exists(public_path('storage'))) {
        return 'The "public/storage" directory already exists.';
    }

    app('files')->link(
        storage_path('app/public'),
        public_path('storage')
    );

    return 'The [public/storage] directory has been linked.';
});

Route::get('/', [Treasures::class,'getAllTreasures'])->name('dashboard')->middleware('auth');


Route::post('/create-account', [Users::class, 'createAccount'])->name('create-account');


Route::get('/dashboard',[Treasures::class,'getAllTreasures'])->name('dashboard')->middleware('auth');


Route::post('/authenticate-user', [Users::class, 'authenticate'])->name('authenticate-user');


Route::get('/login',function (){
    return view('login');
})->name('login');


Route::get('/user-profile/{id}',[Users::class,'userProfile'])->name('user-profile')->middleware('auth');




Route::post('profile-update-picture',[Users::class,'update_profile_picture'])->name('profile-update-picture')->middleware('auth');

Route::post('update_profile_details',[Users::class,'update_profile_details'])->name('update_profile_details')->middleware('auth');


Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('/welcome',function (){
    return view('welcome');
})->name('welcome');


Route::get('/add_treasures',function (){
    return view('treasures.add_treasures');
})->name('add_treasures')->middleware('auth');


Route::post('/addTreasure',[Treasures::class,'addTreasure'])->name('addTreasure')->middleware('auth');

Route::get('/getallTreasures',[Treasures::class,'getAllTreasures'])->name('getAllTreasures')->middleware('auth');

Route::get('treasure_details/{id}',[Treasures::class,'treasureDetails'])->name('treasureDetails')->middleware('auth');





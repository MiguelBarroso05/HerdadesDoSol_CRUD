<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AccommodationTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

Route::group(['middleware' => 'auth'], function () {
    #Routes Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

    #Routes Users
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/users/{user}/recover', [UserController::class, 'recover'])->name('users.recover');
    Route::resource('users', UserController::class);

    #Routes Accommodations
    Route::resource('accommodations', AccommodationController::class);
    Route::resource('accommodation_types', AccommodationTypeController::class);

    #Routes Activities
    Route::resource('activities', ActivityController::class);

    #Routes Logout
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/{page}', [PageController::class, 'index'])->name('page'); //Altera esta m**da Marco!!
});

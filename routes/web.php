<?php

use App\Http\Controllers\accommodation\AccommodationController;
use App\Http\Controllers\accommodation\AccommodationTypeController;
use App\Http\Controllers\activity\ActivityController;
use App\Http\Controllers\activity\ActivityTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\login\ChangePassword;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\login\RegisterController;
use App\Http\Controllers\login\ResetPassword;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\UserProfileController;
use App\Models\accommodation\Accommodation;
use App\Models\accommodation\AccommodationType;
use App\Models\activity\Activity;
use Illuminate\Support\Facades\Route;

#Routes HomePage
Route::get('/', function () {
    return view('pages.home', [
        'activities' => Activity::take(3)->get(),
        'accommodations' => Accommodation::take(9)->get(),
        'accommodation_types' => AccommodationType::take(3)->get(),
    ]);
})->name('home');

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
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/sales_overview', [HomeController::class, 'salesOverview'])->name('sales.overview');;

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
    Route::resource('activity_types', ActivityTypeController::class);

    #Routes Logout
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

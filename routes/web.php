<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerification;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PasswordResetcontroller;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Two\GoogleProvider;

Route::view('/','welcome')->name('home');


Route::middleware('guest')->group(function(){
    Route::view('/login','auth.login')->name('view.login');

    Route::view('/register','auth.register')->name('view.register');

    Route::post('/login',[AuthController::class,'login'])->name('login');

    Route::post('/register',[AuthController::class,'register'])->name('register');

    Route::view('/password_reset','auth.forgot-password')->name('password.request');

    Route::get('/reset-password/{token}',[PasswordResetcontroller::class,'see'])->name('password.reset');

    Route::post('/password_reset',[PasswordResetcontroller::class,'send'])->name('password.email');

Route::post('/reset-password',[PasswordResetcontroller::class,'reset'])->name('password.update');

/*Route::get('/auth/github/redirect',[ProvidersController::class,'redirect'])->name('redirect');
Route::get('/auth/github/callback',[ProvidersController::class,'callback']);**/

Route::get('/auth/google/redirect',[GoogleController::class,'redirect'])->name('google.redirect');
Route::get('/auth/google/callback',[GoogleController::class,'callback']);


});

Route::middleware('auth')->group(function(){
    Route::view('/set-password','auth.set-password')->name('view.set-password');
    Route::post('/set-password',[GoogleController::class,'set'])->name('set.password');

    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    Route::view('/profile','auth.profile')->middleware('verified')->name('view.profile');

    Route::post('/profile/update',[UserController::class,'update'])->name('update');

    Route::post('/profile/update_password',[UserController::class,'update_password'])->name('update_password');

    Route::post('/profile/delete',[UserController::class,'destroy'])->name('destroy');

    Route::view('/email/verify','auth.verify-email')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}',[EmailVerification::class,'verifyemail'])->name('verification.verify');

    Route::post('/email/verification-notification',[EmailVerification::class,'sendemail'])->middleware('throttle:6,1')->name('verification.send');
});

<?php

use Illuminate\Support\Facades\Route;
use Netgen\Register\Classes\RegisterUser;
use Netgen\Register\Classes\SendOtp;
use Netgen\Register\Components\UserLogin;

Route::get('/generate-otp', [SendOtp::class, 'generateOTP']);
Route::get('/generate-login-otp', [SendOtp::class, 'generateLoginOTP']);
Route::get('/user-otp', [SendOtp::class, 'sendOtp']);
Route::get('/user-otp-login', [SendOtp::class, 'checklogin']);
Route::get('/verify-otp', [SendOtp::class, 'verifyOtp']);
Route::get('/register-user', [RegisterUser::class, 'registerUser']);
Route::get('/save-register-user', [SendOtp::class, 'saveRegisterUser']);

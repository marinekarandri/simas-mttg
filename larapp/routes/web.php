<?php

use Illuminate\Support\Facades\Route;


// Dashboard: hanya butuh autentikasi (auth). Verified biasanya memeriksa email/akun terverifikasi.
// Provide explicit GET view route for login so front 'Login' link always loads the login form.
// Fortify handles the POST /login authentication; this GET route maps to the Blade view.
Route::view('/login', 'auth.login')->middleware('guest')->name('login');

Route::view('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');

Route::view('/', 'home');
Route::view('/mosque', 'mosque');




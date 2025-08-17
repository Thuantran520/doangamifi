<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/test-insert', function () {
    $u = \App\Models\User::create([
        'name' => 'Demo',
        'email' => 'demo'.mt_rand(1000,9999).'@gmail.com',
        'password' => bcrypt('123456'),
        'username' => 'demo'.mt_rand(1000,9999),
        'phone' => null,
    ]);
    return $u;
});

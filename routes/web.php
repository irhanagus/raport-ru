<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\StudentController;


Route::get('/login', [LoginController::class, 'halamanlogin'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'ceklevel:admin'])->group(function () {

    Route::get('/', function () {return view('home');})->name('home');

    Route::get('data-user', [UserController::class, 'index'])->name('data-user');
    Route::post('store-user', [UserController::class, 'store'])->name('store-user');
    Route::put('update-user/{id}', [UserController::class, 'update'])->name('update-user');
    Route::get('delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');

    Route::get('/data-sekolah', [SekolahController::class, 'index'])->name('data-sekolah');
    Route::post('/store-sekolah', [SekolahController::class, 'store'])->name('store-sekolah');
    Route::put('/update-sekolah/{id}', [SekolahController::class, 'update']);
    Route::get('/delete-sekolah/{id}', [SekolahController::class, 'destroy']);

    Route::get('/data-student', [StudentController::class, 'index'])->name('data-student');
    Route::post('/store-student', [StudentController::class, 'store'])->name('store-student');
    Route::put('/update-student/{id}', [StudentController::class, 'update']);
    Route::get('/delete-student/{id}', [StudentController::class, 'destroy']);
    
});
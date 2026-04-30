<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\KelasController;


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

    Route::get('data-learning', [LearningController::class, 'index'])->name('data-learning');
    Route::post('store-learning', [LearningController::class, 'store'])->name('store-learning');
    Route::put('update-learning/{id}', [LearningController::class, 'update'])->name('update-learning');
    Route::get('delete-learning/{id}', [LearningController::class, 'destroy'])->name('delete-learning');

    Route::get('data-kelas', [KelasController::class, 'index'])->name('data-kelas');
    Route::post('store-kelas', [KelasController::class, 'store'])->name('store-kelas');
    Route::put('update-kelas/{id}', [KelasController::class, 'update'])->name('update-kelas');
    Route::get('delete-kelas/{id}', [KelasController::class, 'destroy'])->name('delete-kelas');
    
});
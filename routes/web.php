<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthenticationSession;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware([AuthenticationSession::class])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    
    Route::get('/', [StudentController::class, 'index'])->name('std.students');
    Route::post('/create-new', [StudentController::class, 'createNewSTD'])->name('std.create');
    Route::put('/update-students/{id}', [StudentController::class, 'updateSTD'])->name('std.update');
    Route::delete('/delete-student/{id}', [StudentController::class, 'deleteSTD'])->name('std.delete');
});


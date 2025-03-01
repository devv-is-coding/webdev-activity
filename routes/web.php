<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

//Student Routes
Route::get('/', [StudentController::class, 'index'])->name('std.students');

//Create New Students
Route::post('/create-new', [StudentController::class, 'createNewSTD'])->name('std.create');

Route::put('/update-students/{id}', [StudentController::class, 'updateSTD'])->name('std.update');

Route::delete('/delete-student/{id}', [StudentController::class, 'deleteSTD'])->name('std.delete');

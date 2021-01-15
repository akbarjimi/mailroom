<?php

use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');
Route::resource("users", UserController::class);

Route::get('lettertypes/{lettertype}/delete', [LetterTypeController::class, 'delete'])->name('lettertypes.delete');
Route::resource("lettertypes", LetterTypeController::class);

Route::get('projects/{project}/delete', [ProjectController::class, 'delete'])->name('projects.delete');
Route::resource("projects", ProjectController::class);

Route::get('letters/{letter}/delete', [LetterController::class, 'delete'])->name('letters.delete');
Route::resource("letters", LetterController::class);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClassroomController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::prefix('/classroom')->group(function () {
    Route::get('/', [ClassroomController::class, 'index'])->name('classroom.index');
    Route::get('/create', [ClassroomController::class, 'create'])->name('classroom.create');
    Route::get('/{classroom}/edit', [ClassroomController::class, 'edit'])->name('classroom.edit');
    Route::get('/{classroom}/show', [ClassroomController::class, 'show'])->name('classroom.show');
    Route::delete('/{classroom}', [ClassroomController::class, 'destroy'])->name('classroom.destroy');
    });
});


require __DIR__.'/auth.php';

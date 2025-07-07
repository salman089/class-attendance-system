<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\RoleController;

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

    // Classroom
    Route::prefix('/classroom')->group(function () {
        Route::get('/', [ClassroomController::class, 'index'])->name('classroom.index');
        Route::get('/create', [ClassroomController::class, 'create'])->name('classroom.create');
        Route::get('/{classroom}/edit', [ClassroomController::class, 'edit'])->name('classroom.edit');
        Route::get('/{classroom}/show', [ClassroomController::class, 'show'])->name('classroom.show');
        Route::delete('/{classroom}', [ClassroomController::class, 'destroy'])->name('classroom.destroy');
    });

    // User
    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::get('/{user}/show', [UserController::class, 'show'])->name('user.show');

        Route::prefix('/roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('user.role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('user.role.create');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('user.role.edit');
            Route::get('/{role}/show', [RoleController::class, 'show'])->name('user.role.show');
        });
    });
});


require __DIR__ . '/auth.php';

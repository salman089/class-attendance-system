<?php

use App\Livewire\Subject\Mark;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\AttendanceController;

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

    // Classrooms
    Route::prefix('/classrooms')->group(function () {
        Route::get('/', [ClassroomController::class, 'index'])->name('classroom.index')->middleware('can:list_classrooms');
        Route::get('/create', [ClassroomController::class, 'create'])->name('classroom.create')->middleware('can:create_classrooms');
        Route::get('/{classroom}/edit', [ClassroomController::class, 'edit'])->name('classroom.edit')->middleware('can:edit_classrooms');
        Route::get('/{classroom}/show', [ClassroomController::class, 'show'])->name('classroom.show')->middleware('can:view_classrooms');
        Route::delete('/{classroom}', [ClassroomController::class, 'destroy'])->name('classroom.destroy')->middleware('can:delete_classrooms');
    });

    // Subjects
    Route::prefix('/subjects')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('subject.index')->middleware('can:list_subjects');
        Route::get('/create', [SubjectController::class, 'create'])->name('subject.create')->middleware('can:create_subjects');
        Route::get('/{subject}/edit', [SubjectController::class, 'edit'])->name('subject.edit')->middleware('can:edit_subjects');
        Route::get('/{subject}/show', [SubjectController::class, 'show'])->name('subject.show')->middleware('can:view_subjects');
    });

    Route::prefix('/attendances')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/mark/{subjectId}/{date}', [AttendanceController::class, 'mark'])->name('attendance.mark');
        Route::get('/attendances/show/{subjectId}/{date}', [AttendanceController::class, 'show'])->name('attendance.show');
    });

    // Users
    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index')->middleware('can:list_users');
        Route::get('/create', [UserController::class, 'create'])->name('user.create')->middleware('can:create_users');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('can:edit_users');
        Route::get('/{user}/show', [UserController::class, 'show'])->name('user.show')->middleware('can:view_users');

        // Roles
        Route::prefix('/roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('user.role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('user.role.create');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('user.role.edit');
            Route::get('/{role}/show', [RoleController::class, 'show'])->name('user.role.show');
        });
    });
});


require __DIR__ . '/auth.php';

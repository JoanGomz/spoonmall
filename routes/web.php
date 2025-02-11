<?php

use App\Http\Controllers\Admin\Permissions\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

    // Route::get('/admin/users', [UsersController::class, 'index'])->name('users.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/admin/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::put('/admin/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/admin/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::get('/admin/roles', [PermissionController::class, 'index'])->name('roles.index');
    Route::post('/admin/roles', [PermissionController::class, 'store'])->name('roles.store');
    Route::put('/admin/roles/{role}', [PermissionController::class, 'update'])->name('roles.update');
    Route::delete('/admin/roles/{role}', [PermissionController::class, 'destroy'])->name('roles.destroy');
});


require __DIR__ . '/auth.php';

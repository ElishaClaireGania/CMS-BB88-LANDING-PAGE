<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

// Public Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('home');

// Public API endpoints for section data
Route::get('/api/public/get_sections.php', [LandingPageController::class, 'getSection']);
Route::get('/api/public/sections/{section}', [LandingPageController::class, 'getSection']);

// Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/admin/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/admin/register', [AuthController::class, 'register']);
Route::match(['get', 'post'], '/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Dashboard Routes
Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/sections/{section}', [AdminController::class, 'editSection'])->name('admin.sections.edit');
    Route::post('/sections/{section}', [AdminController::class, 'updateSection'])->name('admin.sections.update');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [BookingController::class, 'index'])->name('home');
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/{test}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking/{test}', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{submitCode}', [BookingController::class, 'success'])->name('booking.success');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Tests Management
    Route::get('/tests', [AdminController::class, 'tests'])->name('admin.tests');
    Route::get('/tests/create', [AdminController::class, 'createTest'])->name('admin.tests.create');
    Route::post('/tests', [AdminController::class, 'storeTest'])->name('admin.tests.store');
    Route::get('/tests/{test}/edit', [AdminController::class, 'editTest'])->name('admin.tests.edit');
    Route::put('/tests/{test}', [AdminController::class, 'updateTest'])->name('admin.tests.update');
    
    // Bookings Management
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::get('/bookings/{booking}', [AdminController::class, 'showBooking'])->name('admin.bookings.show');
    Route::post('/bookings/{booking}/verify', [AdminController::class, 'verifyBooking'])->name('admin.bookings.verify');
});

// Custom 404
Route::fallback(function () {
    return view('errors.404');
});

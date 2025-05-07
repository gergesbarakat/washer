<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\ProductController;
use App\Models\Branch;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('user')->name('user.')->middleware('auth:user')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/', action: function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/profile', [AdminController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AdminController::class, 'destroy'])->name('profile.destroy');

    Route::resource('parcels', ParcelController::class);
    Route::resource(  'branches', BranchController::class);

    Route::resource( 'categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});



Route::prefix('courier')->name('courier.')->middleware('auth:courier')->group(function () {

    Route::get('/', action: function () {
        return view('courier.dashboard');
    })->name('dashboard');

    Route::get('/dashboard', function () {
        return view('courier.dashboard');
    })->name('dashboard');
    Route::get('/profile', [CourierController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [CourierController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [CourierController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

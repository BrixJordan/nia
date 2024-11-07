<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StickerController;
use App\Http\Controllers\DTRController;
use App\Http\Controllers\EmployeeController;
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
});

// Stickers routes
Route::get('/stickers/sticker', [StickerController::class, 'index'])->name('stickers.index');
Route::post('/stickers', [StickerController::class, 'store'])->name('stickers.store');
Route::delete('/stickers/{id}', [StickerController::class, 'destroy'])->name('stickers.destroy');
Route::get('/stickers/{id}/edit', [StickerController::class, 'edit'])->name('stickers.edit');
Route::put('/stickers/{id}', [StickerController::class, 'update'])->name('stickers.update');
Route::delete('/stickers/{id}', [StickerController::class, 'destroy'])->name('stickers.destroy');

// DTR routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dtr', [DTRController::class, 'index'])->name('dtr.index');
    Route::post('/dtr/upload-excel', [DTRController::class, 'importExcel'])->name('dtr.import');
    Route::get('/dtr/export', [DTRController::class, 'export'])->name('dtr.export');
    Route::get('/dtr/generate', [DTRController::class, 'generateDTR'])->name('dtr.generate');
    Route::post('/dtr/download', [DTRController::class, 'downloadDTR'])->name('dtr.download');

    
});

// Employee routes
Route::middleware(['auth'])->group(function () {
    Route::resource('employee', EmployeeController::class);
    Route::post('/employee/upload-excel', [EmployeeController::class, 'importExcel'])->name('employees.import');
});

require __DIR__.'/auth.php';
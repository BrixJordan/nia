<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StickerController;
use App\Http\Controllers\DTRController;
use App\Http\Controllers\employeeController;
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

Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');

Route::get('/stickers/sticker', [StickerController::class, 'index'])->name('stickers.index');
Route::post('/stickers', [StickerController::class, 'store'])->name('stickers.store');
Route::delete('/stickers/{id}', [StickerController::class, 'destroy'])->name('stickers.destroy');
Route::get('/stickers/{id}/edit', [StickerController::class, 'edit'])->name('stickers.edit');
Route::put('/stickers/{id}', [StickerController::class, 'update'])->name('stickers.update');
Route::delete('/stickers/{id}', [StickerController::class, 'destroy'])->name('stickers.destroy');

Route::resource('stickers', StickerController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('dtr', DTRController::class);
    Route::post('/dtr/upload-excel', [DTRController::class, 'importExcel'])->name('dtr.import'); 
});

Route::middleware(['auth'])->group(function () {
    Route::resource('employee', EmployeeController::class);
    Route::post('/employee/upload-excel', [EmployeeController::class, 'importExcel'])->name('employees.import');
});










require __DIR__.'/auth.php';
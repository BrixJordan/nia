<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StickerController;
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





require __DIR__.'/auth.php';

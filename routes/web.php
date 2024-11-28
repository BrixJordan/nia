<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StickerController;
use App\Http\Controllers\DTRController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TicketController;
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

Route::resource('stickers', StickerController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('ticket', TicketController::class)->names([
        'index' => 'Ticket.index',
        'store' => 'ticket.store',

    ]);
});



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
    Route::delete('employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});

require __DIR__.'/auth.php';
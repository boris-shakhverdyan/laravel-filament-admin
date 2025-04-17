<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ActivityController::class, 'index'])->name('home');
Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/favorites', [ActivityController::class, 'favorites'])->name('activities.favorites');

    Route::post('/activities/{activity}/favorite', [ActivityController::class, 'favorite'])->name('activities.favorite');
    Route::delete('/activities/{activity}/favorite', [ActivityController::class, 'unfavorite'])->name('activities.unfavorite');
});

require __DIR__.'/auth.php';

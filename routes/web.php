<?php

use App\Http\Controllers\ChainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromptController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chain', [ChainController::class, 'index'])->name('chain.index');
    Route::post('/chain', [ChainController::class, 'store'])->name('chain.store');
    Route::get('/chain/{chain}', [ChainController::class, 'show'])->name('chain.show');
    Route::delete('/chain/{chain}', [ChainController::class, 'destroy'])->name('chain.destroy');

    Route::post('/prompt', [PromptController::class, 'store'])->name('prompt.store');
    Route::patch('/prompt/{prompt}', [PromptController::class, 'update'])->name('prompt.update');
    Route::delete('/prompt/{prompt}', [PromptController::class, 'destroy'])->name('prompt.destroy');
});

require __DIR__ . '/auth.php';

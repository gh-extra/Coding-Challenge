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

    Route::resource('chains', ChainController::class);
    Route::post('/chains/{chain}/run', [ChainController::class, 'run'])->name('chains.run');

    Route::resource('chains.prompts', PromptController::class)
         ->only(['store', 'update', 'destroy']);
    Route::post('/chains/{chain}/prompts/{prompt}/run', [PromptController::class, 'run'])->name('chains.prompts.run');
});

require __DIR__ . '/auth.php';

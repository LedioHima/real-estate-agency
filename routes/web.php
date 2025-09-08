<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AgentController;

Route::resource('agents', AgentController::class);

// Home route
Route::get('/', [PropertyController::class, 'index'])->name('home');

// Show a single property
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

// Property management (CRUD)
Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');

Route::get('/properties/{property:slug}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
Route::put('/properties/{property:slug}', [PropertyController::class, 'update'])->name('properties.update');

Route::delete('/properties/{property:slug}', [PropertyController::class, 'destroy'])->name('properties.destroy');

// Debug route
Route::get('/debug', function () {
    $q = request('q', 'none');
    dd(['message' => 'Debug route hit', 'query' => $q]);
});

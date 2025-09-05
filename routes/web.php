<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::get('/', [PropertyController::class, 'index'])->name('home');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

// 🚫 REMOVE or comment out these old ones
// Route::get('/', function () { ... });
// Route::get('/properties/{id}', function (int $id) { ... });

// Keep debug if you still want it
Route::get('/debug', function () {
    $q = request('q', 'none');
    dd(['message' => 'Debug route hit', 'query' => $q]);
});

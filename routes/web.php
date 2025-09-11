<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;



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

// ==========================
// NEW: Properties Index for Agent's "My Properties"
// ==========================
Route::get('/properties', [PropertyController::class, 'myProperties'])
    ->middleware('auth') // only logged-in users
    ->name('properties.index');


// ==========================
// NEW: Profile Route
// ==========================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


// Debug route
Route::get('/debug', function () {
    $q = request('q', 'none');
    dd(['message' => 'Debug route hit', 'query' => $q]);
});


Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Example dashboard route
Route::get('/dashboard', function () {
    $user = auth()->guard()->user();
    return view('dashboard', compact('user'));
})->middleware('auth')->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/agents', [AgentController::class, 'index'])->name('agents.index');
    Route::get('/agents/create', [AgentController::class, 'create'])->name('agents.create');
    Route::post('/agents', [AgentController::class, 'store'])->name('agents.store');
    Route::get('/agents/{user}/edit', [AgentController::class, 'edit'])->name('agents.edit');
    Route::put('/agents/{user}', [AgentController::class, 'update'])->name('agents.update');
    Route::delete('/agents/{user}', [AgentController::class, 'destroy'])->name('agents.destroy');
});


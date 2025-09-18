<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;

// ------------------------------
// Public Routes
// ------------------------------

// Home route
Route::get('/', [PropertyController::class, 'index'])->name('home');

// Register & Login
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Debug route
Route::get('/debug', function () {
    dd(['message' => 'Debug route hit', 'query' => request('q', 'none')]);
});

// ------------------------------
// Authenticated Routes
// ------------------------------
Route::middleware(['auth'])->group(function () {

    // Dashboard
   Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

    //Manage Guest 
    Route::resource('guests', GuestController::class)->only(['index', 'destroy']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Agent Management
    Route::get('/agents', [AgentController::class, 'index'])->name('agents.index');
    Route::get('/agents/create', [AgentController::class, 'create'])->name('agents.create');
    Route::post('/agents', [AgentController::class, 'store'])->name('agents.store');
    Route::get('/agents/{user}/edit', [AgentController::class, 'edit'])->name('agents.edit');
    Route::put('/agents/{user}', [AgentController::class, 'update'])->name('agents.update');
    Route::delete('/agents/{user}', [AgentController::class, 'destroy'])->name('agents.destroy');

    // ------------------------------
    // Properties for Logged-in Agent
    // ------------------------------
    // Static route FIRST
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');

    // Agent's properties list
    //Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties', [PropertyController::class, 'myProperties'])->name('properties.index');

    // Edit, Update, Delete
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');

    // Favorites
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{property}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{property}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::post('/favorites/{property}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

});

// ------------------------------
// Dynamic Property Route (public, LAST)
// ------------------------------
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

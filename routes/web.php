<?php
use Illuminate\Support\Facades\Route;

// Listings Routes (Direct to Views)
Route::get('/', function () {
    return view('listings.index');
})->name('listings.index');

Route::get('/listings/create', function () {
    return view('listings.create');
})->name('listings.create');

Route::get('/listings/{id}', function ($id) {
    return view('listings.show', ['id' => $id]);
})->name('listings.show');

Route::get('/listings/{id}/edit', function ($id) {
    return view('listings.edit', ['id' => $id]);
})->name('listings.edit');

Route::get('/listings/manage', function () {
    return view('listings.manage');
})->name('listings.manage');
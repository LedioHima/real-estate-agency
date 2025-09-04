<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::get('/', [PropertyController::class, 'index']);

Route::get('/', function () {
    // Dummy data only for Phase 1
    $properties = [
        [
            'id' => 1,
            'title' => 'Modern 2BR Apartment near City Center',
            'city' => 'Tirana',
            'type' => 'Apartment',
            'price' => 120000,
            'image' => null,
            'description' => 'Bright, modern apartment close to amenities.',
        ],
        [
            'id' => 2,
            'title' => 'Cozy Family Home with Garden',
            'city' => 'Durrës',
            'type' => 'House',
            'price' => 210000,
            'image' => null,
            'description' => 'Spacious living areas, perfect for families.',
        ],
        [
            'id' => 3,
            'title' => 'Penthouse with Stunning Views',
            'city' => 'Vlorë',
            'type' => 'Penthouse',
            'price' => 350000,
            'image' => null,
            'description' => 'Top-floor living with panoramic sea views.',
        ],
    ];

    return view('properties.index', ['properties' => $properties]);
})->name('home');

// Wildcard endpoint + constraint
Route::get('/properties/{id}', function (int $id) {
    $all = [
        1 => (object)[
            'id'=>1,'title'=>'Modern 2BR Apartment near City Center','city'=>'Tirana',
            'type'=>'Apartment','price'=>120000,'description'=>'Bright, modern apartment close to amenities.'
        ],
        2 => (object)[
            'id'=>2,'title'=>'Cozy Family Home with Garden','city'=>'Durrës',
            'type'=>'House','price'=>210000,'description'=>'Spacious living areas, perfect for families.'
        ],
        3 => (object)[
            'id'=>3,'title'=>'Penthouse with Stunning Views','city'=>'Vlorë',
            'type'=>'Penthouse','price'=>350000,'description'=>'Panoramic sea views.'
        ],
    ];

    abort_if(! isset($all[$id]), 404);

    return view('properties.show', ['property' => $all[$id]]);
})->whereNumber('id')->name('properties.show');

// Quick die-dump test (remove later)
Route::get('/debug', function () {
    $q = request('q', 'none');
    dd(['message' => 'Debug route hit', 'query' => $q]);
});

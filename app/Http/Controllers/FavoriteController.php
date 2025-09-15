<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Property $property)
    {
        $user = Auth::user();

        // Prevent duplicate
        if (!$user->favorites()->where('property_id', $property->id)->exists()) {
            $user->favorites()->create(['property_id' => $property->id]);
        }

        return back()->with('success', 'Added to favorites!');
    }

    public function index()
    {
        $favorites = Auth::user()->favorites()->with('property')->get();
        return view('favorites.index', compact('favorites'));
    }

    public function destroy(Property $property)
    {
        Auth::user()->favorites()->where('property_id', $property->id)->delete();
        return back()->with('success', 'Removed from favorites.');
    }
}


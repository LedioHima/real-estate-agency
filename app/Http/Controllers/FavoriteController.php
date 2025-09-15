<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Property $property)
    {
        $user = Auth::user();

        // Prevent duplicate favorites
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

    /**
     * Toggle favorite status
     */
    public function toggle(Property $property)
    {
        $user = Auth::user();

        // try to find existing favorite
        $existing = $user->favorites()->where('property_id', $property->id)->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Removed from favorites.');
        }

        // create new
        $user->favorites()->create(['property_id' => $property->id]);

        return back()->with('success', 'Added to favorites!');
    }
    
}

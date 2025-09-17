<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'guest':
    $query = Property::with('agent');

    if (request()->filled('search')) {
        $search = request('search');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('city', 'LIKE', "%{$search}%");
        });
    }

    $properties = $query->latest()->paginate(9);
      $slideshowProperties = Property::whereNotNull('image')
        ->latest()
        ->take(5)
        ->get();

    return view('properties.guest_index', compact('user', 'properties', 'slideshowProperties'));

            case 'admin':
    $query = Property::with('agent');

    if (request()->filled('search')) {
        $search = request('search');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('city', 'LIKE', "%{$search}%");
        });
    }

    $properties = $query->latest()->paginate(9); // paginate recommended
    return view('admin.dashboard', compact('user', 'properties'));


           case 'agent':
    $query = Property::where('user_id', $user->id)->with('agent');

    if (request()->filled('search')) {
        $search = request('search');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('city', 'LIKE', "%{$search}%");
        });
    }

    $properties = $query->latest()->paginate(9);
    return view('agents.dashboard', compact('user', 'properties'));

        }
    }
}

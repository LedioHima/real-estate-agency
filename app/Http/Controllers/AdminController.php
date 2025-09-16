<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class AdminController extends Controller
{
    public function dashboard(Request $request)
{
    $query = Property::query();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('title', 'LIKE', "%{$search}%")
              ->orWhere('city', 'LIKE', "%{$search}%");
    }

    $properties = $query->latest()->get();

    return view('admin.dashboard', compact('properties'));
}

}

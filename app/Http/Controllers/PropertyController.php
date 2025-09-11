<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of all properties with their agents.
     */
    public function index()
    {
        // Eager load the 'agent' relationship to avoid N+1 queries
        $properties = Property::with('agent')->get();

        return view('properties.index', compact('properties'));
    }

    /**
     * Display a single property and its agent.
     */
    public function show($id)
    {
        // Find a property by ID with its agent, or fail with 404
        $property = Property::with('agent')->findOrFail($id);

        return view('properties.show', compact('property'));
    }

    public function myProperties()
    {
        $user = auth()->guard()->user();

        // Fetch onlygit ch properties that belong to the logged-in agent
        $properties = \App\Models\Property::where('user_id', Auth::id())->get();

        return view('properties.index', compact('properties'));
    }

     // Show create form
    public function create()
    {
        return view('properties.create');
    }

    // Store property
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('properties', 'public');
        }

        // Create property
        Property::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'city' => $request->city,
            'type' => $request->type,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
            'user_id' => Auth::id(), // logged-in agent
        ]);

        return redirect()->route('properties.index')->with('success', 'Property added successfully.');
    }

}

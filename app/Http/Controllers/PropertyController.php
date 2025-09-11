<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

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

        // Fetch only properties that belong to the logged-in agent
        $properties = \App\Models\Property::where('user_id', $user->id)->get();

        return view('properties.index', compact('properties'));
    }

}

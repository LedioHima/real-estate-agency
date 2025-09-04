<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        // Fetch all properties (currently returns arrays)
        $properties = Property::all()->map(function ($property) {
            return (object) $property; // Convert each array into an object
        });

        return view('properties.index', compact('properties'));
    }


}

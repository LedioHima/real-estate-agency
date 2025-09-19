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
   public function index(Request $request)
{
    $search = $request->input('search');
    $minPrice = $request->input('min_price');
    $maxPrice = $request->input('max_price');
    $sort = $request->input('sort'); // new sort option

    $query = Property::with('agent');

    // Search filter
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('city', 'like', "%{$search}%")
              ->orWhere('type', 'like', "%{$search}%");
        });
    }

    // Price range filter
    if ($minPrice) {
        $query->where('price', '>=', $minPrice);
    }
    if ($maxPrice) {
        $query->where('price', '<=', $maxPrice);
    }

    // Sorting
    if ($sort === 'low-high') {
        $query->orderBy('price', 'asc');
    } elseif ($sort === 'high-low') {
        $query->orderBy('price', 'desc');
    } else {
        $query->latest(); // default: newest properties first
    }

    $properties = $query->paginate(9);
      $slideshowProperties = Property::whereNotNull('image')
        ->latest()
        ->take(5)
        ->get();

    return view('properties.guest_index', compact('properties', 'search', 'minPrice', 'maxPrice', 'sort', 'slideshowProperties'));
}

    /**
     * Display a single property (public).
     * Route model binding by slug is used: {property:slug}
     */
    public function show(Property $property)
    {
        $property->load('agent'); // eager load agent
        return view('properties.show', compact('property'));
    }

    /**
     * Display logged-in agent's properties.
     */
    public function myProperties(Request $request)
    {
        $search = $request->input('search');

        $properties = Property::where('user_id', auth()->guard()->id())
    ->when(request('search'), function ($query, $search) {
        $query->where('title', 'like', "%{$search}%")
              ->orWhere('city', 'like', "%{$search}%")
              ->orWhere('type', 'like', "%{$search}%");
    })
    ->paginate(10); // 👈 paginate instead of get()


        return view('properties.index', compact('properties', 'search'));
    }


    /**
     * Show create form.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store new property.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255|unique:properties,title',
            'city'        => 'nullable|string|max:255',
            'type'        => 'nullable|string|max:255',
            'price'       => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('properties', 'public')
            : null;

        Property::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'city'        => $request->city,
            'type'        => $request->type,
            'price'       => $request->price,
            'image'       => $imagePath,
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('properties.index')
                         ->with('success', 'Property added successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Property $property)
    {
        // Ensure the logged-in user owns this property
        if ($property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('properties.edit', compact('property'));
    }

    /**
     * Update property.
     */
    public function update(Request $request, Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'city'        => 'nullable|string|max:255',
            'type'        => 'nullable|string|max:255',
            'price'       => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'city', 'type', 'price', 'description']);

        // Update slug if title changes
        if ($request->title !== $property->title) {
            $data['slug'] = Str::slug($request->title);
        }

        // Handle image replacement
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('properties', 'public');
        }

        $property->update($data);

        return redirect()->route('properties.index')
                         ->with('success', 'Property updated successfully.');
    }

    /**
     * Delete property.
     */
    public function destroy(Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $property->delete();

        return redirect()->route('properties.index')
                         ->with('success', 'Property deleted successfully.');
    }
}

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
                $properties = Property::with('agent')->get();
                return view('properties.guest_index', compact('user', 'properties'));

            case 'admin':
                return view('admin.dashboard', compact('user'));

            case 'agent':
                // Fetch only the properties belonging to this agent
                $properties = Property::where('agent_id', $user->id)->get();
                return view('agents.dashboard', compact('user', 'properties'));

            default:
                return view('dashboard', compact('user'));
        }
    }
}

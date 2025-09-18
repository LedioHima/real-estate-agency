<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $guests = User::where('role', 'guest')
            ->withCount('favorites')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
                });
            })
            ->latest()
            ->paginate(10);


        return view('guests.index', compact('guests'));
    }

    public function destroy($id)
    {
        $guest = User::where('role', 'guest')->findOrFail($id);
        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Guest deleted successfully!');
    }
}

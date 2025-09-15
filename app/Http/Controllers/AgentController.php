<?php
// app/Http/Controllers/Admin/AgentController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller {
    public function create()
    {
        return view('agents.create'); // make this Blade view
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    // Set role to 'agent'
    $validated['role'] = 'agent';

    // Hash the password
    $validated['password'] = Hash::make($validated['password']);

    User::create($validated);

    return redirect()->route('agents.index')->with('success', 'Agent created successfully.');
}
public function index(Request $request)
{
    $search = $request->input('search');

    $agents = User::where('role', 'agent')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->paginate(10);

    return view('agents.index', compact('agents', 'search'));
}

    public function edit(User $user)
    {
        return view('agents.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('agents.index')->with('success', 'Agent updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
    }
}
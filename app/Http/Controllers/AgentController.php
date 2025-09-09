<?php
// app/Http/Controllers/Admin/AgentController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'agent',
        ]);

        return back()->with('success', 'Agent created successfully!');
    }

    public function index()
{
    $agents = \App\Models\User::where('role', 'agent')->paginate(10);
    return view('agents.index', compact('agents'));
}

}

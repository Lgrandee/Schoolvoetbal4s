<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Create a team for the user
        $team = Team::create([
            'name' => $user->name . "'s Team",
            'points' => 0,
            'creator_id' => $user->id,
            'players' => json_encode([]),
        ]);

        return redirect()->route('home')->with('success', 'User and team created successfully!');
    }
}

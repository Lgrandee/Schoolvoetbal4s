<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'coach' => 'required|string',
            'team_members' => 'required|integer',
            'logo' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $filePath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $filePath;
        }

        Team::create($validated);

        return redirect()->route('home')->with('success', 'Team toegevoegd!');
    }

    public function showHome()
    {
        $topTeams = Team::orderBy('id')->take(5)->get();

        return view('home', compact('topTeams'));
    }

}

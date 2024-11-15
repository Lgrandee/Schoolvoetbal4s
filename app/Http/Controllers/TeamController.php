<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function create()
    {
        return view('creatteam');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'coach' => 'required|string',
            'team_members' => 'required|integer',
            'points' => 'required|integer',
            'logo_path' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $filePath = $request->file('logo')->store('logos', 'public');
            $validated['logo_path'] = $filePath;
        }

        Team::create($validated);

        return redirect()->route('home')->with('success', 'Team toegevoegd!');
    }


}

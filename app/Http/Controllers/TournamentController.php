<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;

class TournamentController extends Controller
{
    public function create()
    {
        return view('tournament.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'max_teams' => 'required|integer|min:2',
        ]);

        $tournament = new Tournament();
        $tournament->title = $request->title;
        $tournament->max_teams = $request->max_teams;
        $tournament->save();

        return redirect()->route('bracket')->with('success', 'Tournament created successfully!');
    }
}

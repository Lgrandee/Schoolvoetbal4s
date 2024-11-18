<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Team;

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

    public function edit(Tournament $tournament)
    {
        $teams = Team::all(); // Fetch all teams
        return view('admin.tournament.edit', compact('tournament', 'teams'));
    }

    public function update(Request $request, Tournament $tournament)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'max_teams' => 'required|integer|min:2',
        ]);

        $tournament->update($request->only('title', 'max_teams'));

        return redirect()->route('admin')->with('success', 'Tournament updated successfully!');
    }

    public function addTeam(Request $request, Tournament $tournament)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $tournament->teams()->attach($request->team_id);

        return redirect()->route('admin.tournament.edit', $tournament)->with('success', 'Team added to tournament!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Team;
use App\Models\Referee;

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
        $referees = Referee::all(); // Fetch all referees
        return view('tournament.edit', compact('tournament', 'teams', 'referees'));
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
            'team_id.*' => 'required|exists:teams,id', // Validate each team ID
        ]);

        foreach ($request->team_id as $teamId) {
            $tournament->teams()->attach($teamId);
        }

        return redirect()->route('admin.tournament.edit', $tournament)->with('success', 'Teams added to tournament!');
    }

    public function addReferee(Request $request, Tournament $tournament)
    {
        $request->validate([
            'referee_name.*' => 'required|string|max:255', // Validate each referee name
        ]);

        foreach ($request->referee_name as $refereeName) {
            // Assuming you have a Referee model and a relationship set up
            $tournament->referees()->create(['name' => $refereeName]);
        }

        return redirect()->route('admin.tournament.edit', $tournament)->with('success', 'Referees added to tournament!');
    }

    public function showBracket(Tournament $tournament)
    {
        $teams = $tournament->teams; // Get teams associated with the tournament

        // Create matchups (assuming 16 teams)
        $matchups = [];
        for ($i = 0; $i < count($teams); $i += 2) {
            if (isset($teams[$i + 1])) {
                $matchups[] = [$teams[$i], $teams[$i + 1]];
            }
        }

        return view('tournament.bracket', compact('tournament', 'matchups'));
    }
}

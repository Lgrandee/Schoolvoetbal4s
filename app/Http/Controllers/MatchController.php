<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Models\Goal;
use App\Models\Tournament;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        $games = Game::with(['teamOne', 'teamTwo', 'referee'])->get();
        $tournaments = Tournament::all(); // Fetch all tournaments
        return view('admin', compact('games', 'tournaments'));
    }

    public function updateMatchScores(Request $request, $gameId)
    {
        $validated = $request->validate([
            'team1_score' => 'required|integer',
            'team2_score' => 'required|integer',
        ]);

        $Game = Game::findOrFail($gameId);
        $Game->update($validated);

        // Update points based on scores
        if ($Game->team1_score > $Game->team2_score) {
            $team1 = Team::find($Game->team1_id);
            $team1->points += 3;
            $team1->save();
        } elseif ($Game->team2_score > $Game->team1_score) {
            $team2 = Team::find($Game->team2_id);
            $team2->points += 3;
            $team2->save();
        } else {
            $team1 = Team::find($Game->team1_id);
            $team1->points += 1;
            $team1->save();

            $team2 = Team::find($Game->team2_id);
            $team2->points += 1;
            $team2->save();
        }

        return redirect()->route('admin')->with('success', 'Gme scores updated and points awarded!');
    }

    public function storeGoal(Request $request, $gameId)
    {
        $validated = $request->validate([
            'player_id' => 'required|exists:users,id',
            'minute' => 'required|integer',
        ]);

        $validated['match_id'] = $gameId;
        Goal::create($validated);

        return redirect()->back()->with('success', 'Goal recorded!');
    }

    public function showCoachForm()
    {
        $tournaments = Tournament::all(); // Fetch all tournaments
        return view('coach', compact('tournaments'));
    }

    public function storeTeam(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'coach' => 'required|string',
            'player_count' => 'required|integer',
            'logo' => 'required|image',
        ]);

        if ($request->hasFile('logo')) {
            $filePath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $filePath;
        }

        $validated['creator_id'] = auth()->id();

        Team::create($validated);

        return redirect()->route('coach')->with('success', 'Team added successfully!');
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

    public function showTeams()
    {
        $teams = Team::all(); // Fetch all teams
        return view('stand', compact('teams')); // Return a view with the teams data
    }

    public function showBrackets()
    {
        $tournaments = Tournament::all(); // Fetch all tournaments
        return view('brackets', compact('tournaments'));
    }
}

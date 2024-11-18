<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Models\Goal;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        $games = Game::with(['teamOne', 'teamTwo', 'referee'])->get();
        return view('admin', compact('games'));
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
}

<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Models\Goal;
use App\Models\Tournament;
use App\Models\TournamentMatch;
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
            'team1_score' => 'required|integer|min:0',
            'team2_score' => 'required|integer|min:0',
        ]);

        $game = Game::findOrFail($gameId);
        $match = TournamentMatch::where('tournament_id', $game->tournament_id)
            ->where('team1_id', $game->team1_id)
            ->where('team2_id', $game->team2_id)
            ->first();

        // Reset points before updating
        $team1 = Team::find($game->team1_id);
        $team2 = Team::find($game->team2_id);

        // Remove old points
        if ($game->team1_score > $game->team2_score) {
            $team1->points -= 3;
        } elseif ($game->team2_score > $game->team1_score) {
            $team2->points -= 3;
        } elseif ($game->team1_score === $game->team2_score && $game->team1_score !== 0) {
            $team1->points -= 1;
            $team2->points -= 1;
        }

        // Update game scores
        $game->update($validated);

        // Award new points
        if ($game->team1_score > $game->team2_score) {
            $team1->points += 3;
            if (!$match->winner_id) {
                $match->winner_id = $team1->id;
            }
        } elseif ($game->team2_score > $game->team1_score) {
            $team2->points += 3;
            if (!$match->winner_id) {
                $match->winner_id = $team2->id;
            }
        } elseif ($game->team1_score === $game->team2_score && $game->team1_score !== 0) {
            $team1->points += 1;
            $team2->points += 1;
        }

        $team1->save();
        $team2->save();
        $match->save();

        return redirect()->back()->with('success', 'Match scores updated and points awarded!');
    }

    public function storeGoal(Request $request, $gameId)
    {
        $validated = $request->validate([
            'player_id' => 'required|exists:users,id',
            'minute' => 'required|integer',
        ]);

        $validated['game_id'] = $gameId;
        Goal::create($validated);

        return redirect()->back()->with('success', 'Goal recorded!');
    }

    public function showCoachForm()
    {
        $user = auth()->user();
        $team = $user->team;
        $tournaments = Tournament::all();
        return view('coach', compact('team', 'tournaments'));
    }


    public function showTeams()
    {
        $teams = Team::orderBy('points', 'desc')->get();
        return view('stand', compact('teams'));
    }

    public function showBrackets()
    {
        $tournaments = Tournament::all(); // Fetch all tournaments
        return view('brackets', compact('tournaments'));
    }

    public function showEditTeamForm()
    {
        $user = auth()->user();
        $team = $user->team;

        if (!$team) {
            return redirect()->route('home')->with('error', 'No team found.');
        }

        return view('coach', compact('team'));
    }

    public function showDetails(TournamentMatch $match)
    {
        $game = Game::where('tournament_id', $match->tournament_id)
            ->where('team1_id', $match->team1_id)
            ->where('team2_id', $match->team2_id)
            ->with(['goals.player'])
            ->first();

        return view('match.details', [
            'match' => $match,
            'game' => $game,
            'tournament' => $match->tournament
        ]);
    }
}

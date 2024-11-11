<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game; // Use the Game model
use App\Models\Referee; // Assuming you have a Referee model
use App\Models\Team; // Assuming you have a Team model
use App\Models\Tournament; // Assuming you have a Tournament model

class MatchController extends Controller
{
    public function index()
    {
        $matches = Game::with(['tournament', 'teamOne', 'teamTwo'])->get();
        $referees = Referee::all();
        $teams = Team::all(); // Fetch all teams
        $tournaments = Tournament::all(); // Fetch all tournaments

        return view('admin', compact('matches', 'referees', 'teams', 'tournaments'));
    }

    public function assignReferee(Request $request, $gameId)
    {
        $request->validate([
            'referee_id' => 'required|exists:referees,id',
        ]);

        $game = Game::findOrFail($gameId);
        $game->referee_id = $request->referee_id;
        $game->save();

        return redirect()->back()->with('success', 'Referee assigned successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game; // Use the Game model
use App\Models\Referee; // Assuming you have a Referee model

class MatchController extends Controller
{
    public function index()
    {
        // Fetch all matches and referees
        $matches = Game::all(); // Fetch all games
        $referees = Referee::all(); // Fetch all referees

        // Pass the matches and referees to the view
        return view('admin', compact('matches', 'referees'));
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

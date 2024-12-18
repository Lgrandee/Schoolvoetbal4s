<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['team1', 'team2', 'tournament'])->get()->map(function ($game) {
            return [
                'id' => $game->id,
                'tournament_id' => $game->tournament_id,
                'tournament_name' => $game->tournament->title,
                'team1_id' => $game->team1_id,
                'team1_name' => $game->team1->name,
                'team2_id' => $game->team2_id,
                'team2_name' => $game->team2->name,
            ];
        });

        return response()->json($games);
    }

    public function showByTournamentId(Request $request)
    {
        $tournamentId = $request->query('tournament_id');
        $games = Game::with(['team1', 'team2', 'tournament'])
            ->where('tournament_id', $tournamentId)
            ->get()
            ->map(function ($game) {
                return [
                    'id' => $game->id,
                    'tournament_id' => $game->tournament_id,
                    'tournament_name' => $game->tournament->title,
                    'team1_id' => $game->team1_id,
                    'team1_name' => $game->team1->name,
                    'team2_id' => $game->team2_id,
                    'team2_name' => $game->team2->name,
                ];
            });

        return response()->json($games);
    }

    public function results()
    {
        $results = Game::with(['teamOne', 'teamTwo'])
            ->get()
            ->map(function ($game) {
                return [
                    'id' => $game->id,
                    'game_id' => $game->id, // Assuming game_id is the same as id
                    'team1_score' => $game->team1_score,
                    'team2_score' => $game->team2_score,
                ];
            });

        return response()->json($results);
    }
}

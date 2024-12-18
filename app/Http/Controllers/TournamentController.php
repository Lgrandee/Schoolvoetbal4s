<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Team;
use App\Models\User;
use App\Models\TournamentMatch;
use App\Models\Game;

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

        return redirect()->route('tournament.edit', $tournament)
            ->with('success', 'Tournament created successfully! You can now add teams.');
    }

    public function edit(Tournament $tournament)
    {
        $teams = Team::all(); // Fetch all teams
        $referees = User::where('role', 'referee')->get(); // Get users with referee role
        return view('tournament.edit', compact('tournament', 'teams', 'referees'));
    }

    public function update(Request $request, Tournament $tournament)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'max_teams' => 'required|integer|min:2',
        ]);

        $tournament->update($request->only('title', 'max_teams'));

        return redirect()->route('tournament.bracket', $tournament)
            ->with('success', 'Tournament updated successfully!');
    }

    public function addTeam(Request $request, Tournament $tournament)
    {
        $request->validate([
            'team_id' => 'array',
            'team_id.*' => 'exists:teams,id',
        ]);

        // Get all selected team IDs from the form
        $selectedTeamIds = $request->team_id ?? [];

        // Get current team IDs in the tournament
        $currentTeamIds = $tournament->teams->pluck('id')->toArray();

        // Teams to remove (in current but not in selected)
        $teamsToRemove = array_diff($currentTeamIds, $selectedTeamIds);

        // Teams to add (in selected but not in current)
        $teamsToAdd = array_diff($selectedTeamIds, $currentTeamIds);

        // Remove teams
        if (!empty($teamsToRemove)) {
            $tournament->teams()->detach($teamsToRemove);
        }

        // Add teams
        if (!empty($teamsToAdd)) {
            $tournament->teams()->attach($teamsToAdd);
        }

        return redirect()->route('tournament.edit', $tournament)
            ->with('success', 'Tournament teams updated successfully!');
    }

    public function addReferee(Request $request, Tournament $tournament)
    {
        $request->validate([
            'referee_id.*' => 'required|exists:users,id',
        ]);

        foreach ($request->referee_id as $refereeId) {
            // Add the referee (user) to the tournament
            $tournament->referees()->attach($refereeId);
        }

        return redirect()->route('admin.tournament.edit', $tournament)
            ->with('success', 'Referees added to tournament!');
    }

    public function showBracket(Tournament $tournament)
    {
        $firstRoundMatches = collect();
        $rounds = [];

        if ($tournament->started) {
            $firstRoundMatches = TournamentMatch::where('tournament_id', $tournament->id)
                ->where('round', 1)
                ->orderBy('match_number')
                ->get();

            // Get matches for subsequent rounds
            $currentRound = 1;
            $hasNextRound = true;

            while ($hasNextRound) {
                $nextRound = $currentRound + 1;
                $nextRoundMatches = TournamentMatch::where('tournament_id', $tournament->id)
                    ->where('round', $nextRound)
                    ->orderBy('match_number')
                    ->get();

                if ($nextRoundMatches->isEmpty()) {
                    $hasNextRound = false;
                } else {
                    $rounds[] = $nextRoundMatches;
                    $currentRound++;
                }
            }
        }

        return view('tournament.bracket', [
            'tournament' => $tournament,
            'matchups' => $firstRoundMatches,
            'rounds' => $rounds
        ]);
    }

    public function advance(Request $request, Tournament $tournament, Team $team)
    {
        // Find the match this team is in
        $match = TournamentMatch::where('tournament_id', $tournament->id)
            ->where(function($query) use ($team) {
                $query->where('team1_id', $team->id)
                      ->orWhere('team2_id', $team->id);
            })
            ->whereNull('winner_id')
            ->first();

        if (!$match) {
            return back()->with('error', 'Match not found');
        }

        // Set winner
        $match->winner_id = $team->id;
        $match->save();

        // Calculate next round match number
        $nextRoundMatchNumber = ceil($match->match_number / 2);

        // Check if this is the final match
        $totalTeams = $tournament->teams->count();
        $maxRounds = ceil(log($totalTeams, 2));

        if ($match->round >= $maxRounds) {
            return redirect()->route('tournament.bracket', $tournament);
        }

        // Create or update next round match
        $nextMatch = TournamentMatch::firstOrCreate([
            'tournament_id' => $tournament->id,
            'round' => $match->round + 1,
            'match_number' => $nextRoundMatchNumber
        ]);

        // Determine if this winner goes to team1 or team2 slot
        if ($match->match_number % 2 !== 0) {
            $nextMatch->team1_id = $team->id;
        } else {
            $nextMatch->team2_id = $team->id;
        }

        $nextMatch->save();

        return redirect()->route('tournament.bracket', $tournament);
    }

    public function signupTeam(Request $request, Tournament $tournament)
    {
        $user = auth()->user();
        $team = $user->team;

        if (!$team) {
            return back()->with('error', 'You need to have a team to sign up for tournaments.');
        }

        if ($tournament->teams->contains($team->id)) {
            return back()->with('error', 'Your team is already signed up for this tournament.');
        }

        // Check if tournament has reached max teams
        if ($tournament->teams->count() >= $tournament->max_teams) {
            return back()->with('error', 'Tournament has reached maximum number of teams.');
        }

        $tournament->teams()->attach($team->id);

        return back()->with('success', 'Your team "' . $team->name . '" has been successfully signed up for the tournament!');
    }

    public function startTournament(Tournament $tournament)
    {
        if (!auth()->user()->is_admin) {
            return back()->with('error', 'Unauthorized action.');
        }

        if ($tournament->teams->count() < 2) {
            return back()->with('error', 'Need at least 2 teams to start the tournament.');
        }

        if ($tournament->started) {
            return back()->with('error', 'Tournament has already started.');
        }

        $teams = $tournament->teams->shuffle();
        \Log::info('Creating matches for tournament: ' . $tournament->id);
        \Log::info('Number of teams: ' . count($teams));

        try {
            \DB::beginTransaction();

            for ($i = 0; $i < count($teams); $i += 2) {
                if (isset($teams[$i + 1])) {
                    $match = TournamentMatch::create([
                        'tournament_id' => $tournament->id,
                        'team1_id' => $teams[$i]->id,
                        'team2_id' => $teams[$i + 1]->id,
                        'round' => 1,
                        'match_number' => ($i / 2) + 1
                    ]);

                    // Create corresponding game record
                    Game::create([
                        'tournament_id' => $tournament->id,
                        'team1_id' => $teams[$i]->id,
                        'team2_id' => $teams[$i + 1]->id,
                        'team1_score' => 0,
                        'team2_score' => 0
                    ]);

                    \Log::info('Created match and game: ' . $match->id);
                }
            }

            $tournament->started = now();
            $tournament->save();

            \DB::commit();
            \Log::info('Tournament started successfully');

            return back()->with('success', 'Tournament has been started!');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error starting tournament: ' . $e->getMessage());
            return back()->with('error', 'Error starting tournament. Please try again.');
        }
    }

    public function show(Tournament $tournament)
    {
        return redirect()->route('tournament.bracket', $tournament);
    }

    public function destroy(Tournament $tournament)
    {
        if (!auth()->user()->is_admin) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Delete all matches associated with this tournament
        TournamentMatch::where('tournament_id', $tournament->id)->delete();

        // Delete the tournament
        $tournament->delete();

        return redirect()->route('admin')
            ->with('success', 'Tournament deleted successfully.');
    }
}

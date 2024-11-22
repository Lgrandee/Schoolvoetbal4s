<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tournament;
use App\Models\Team;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tournament = Tournament::create([
            'title' => 'Spring Tournament',
            'max_teams' => 16,
        ]);

        for ($i = 1; $i <= 16; $i++) {
            $team = Team::create([
                'name' => 'Team ' . $i,
                'points' => 0,
                'creator_id' => 1, // Adjust as necessary
            ]);
            $tournament->teams()->attach($team->id);
        }
    }
}

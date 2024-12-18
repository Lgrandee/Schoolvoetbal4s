<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    protected $fillable = [
        'tournament_id',
        'team1_id',
        'team2_id',
        'team1_score',
        'team2_score'
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}

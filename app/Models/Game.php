<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['team1_id', 'team2_id', 'team1_score', 'team2_score', 'field', 'referee_id', 'time'];

    public function teamOne()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function teamTwo()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function referee()
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}

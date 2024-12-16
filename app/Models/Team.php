<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'points', 'players'];

    public function matches()
    {
        return $this->hasMany(Game::class, 'team1_id')->orWhere('team2_id', $this->id);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'tournament_teams');
    }
    public function coach()
    {
        return $this->belongsTo(User::class, 'id', 'team_id');
    }
}

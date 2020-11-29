<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatcheModel extends Model
{
    const GAMES_COUNT = 5;

    protected $table = 'matche';

    public $timestamps = false;

    public function homeTeam()
    {
       return $this->hasOne(TeamModel::class, 'id', 'home_team_id');
    }

    public function guestTeam()
    {
        return $this->hasOne(TeamModel::class, 'id', 'guest_team_id');
    }
}

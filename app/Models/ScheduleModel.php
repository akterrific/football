<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    protected $table = 'schedule';

    public $timestamps = false;

    static function getByScheduleWeek(int $week = 1)
    {
        return self::where('schedule_week', '=', $week)->get();
    }
}

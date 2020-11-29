<?php

namespace Database\Seeders;

use App\Models\ScheduleModel;
use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $schedules = [
            [
                'home_team_id' => 1,
                'guest_team_id' => 2,
                'schedule_week' => 1,
            ],
            [
                'home_team_id' => 3,
                'guest_team_id' => 4,
                'schedule_week' => 1,
            ],
            [
                'home_team_id' => 1,
                'guest_team_id' => 3,
                'schedule_week' => 2,
            ],
            [
                'home_team_id' => 2,
                'guest_team_id' => 4,
                'schedule_week' => 2,
            ],
            [
                'home_team_id' => 3,
                'guest_team_id' => 2,
                'schedule_week' => 3,
            ],
            [
                'home_team_id' => 4,
                'guest_team_id' => 1,
                'schedule_week' => 3,
            ],
            [
                'home_team_id' => 2,
                'guest_team_id' => 1,
                'schedule_week' => 4,
            ],
            [
                'home_team_id' => 4,
                'guest_team_id' => 3,
                'schedule_week' => 4,
            ],
        ];

        foreach($schedules as $schedule) {
            ScheduleModel::create($schedule);
        }
    }
}

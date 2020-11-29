<?php

namespace Database\Seeders;

use App\Models\TeamModel;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'name' => 'Real Madrid',
                'power' => 85,
            ],
            [
                'name' => 'Juventus',
                'power' => 74,
            ],
            [
                'name' => 'Manchester United',
                'power' => 63,
            ],
            [
                'name' => 'Dynamo Kiev',
                'power' => 65,
            ],
        ];

        foreach($teams as $team) {
            TeamModel::create($team);
        }
    }
}

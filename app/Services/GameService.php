<?php

namespace App\Services;

use App\Models\MatcheModel;
use App\Models\ScheduleModel;
use App\Models\TeamModel;

/**
 * Class GameService
 * @package App\Services
 */
class GameService
{
    /**
     * @param int $week
     */
    public function play(int $week = 1)
    {
        $schedules = ScheduleModel::getByScheduleWeek($week);

        foreach($schedules as $schedule){

            $home_team = TeamModel::find($schedule->home_team_id);
            $guest_team = TeamModel::find($schedule->guest_team_id);

            $home_team_goals = ceil(mt_rand(0, $home_team->power) / 10);
            $guest_team_goals = ceil(mt_rand(0, $guest_team->power) / 10);

            // insert matches
            $this->makeMatch(
                [
                    'home_team_id' => $schedule->home_team_id,
                    'guest_team_id' => $schedule->guest_team_id,
                    'goal_home_team' => $home_team_goals,
                    'goal_guest_team' => $guest_team_goals,
                    'schedule_week' => $week,
                ]
            );

            // who wins
            switch($home_team_goals <=> $guest_team_goals){
                case 1:
                    $home_team->win++;
                    $home_team->goal_differential += $home_team_goals - $guest_team_goals;
                    $home_team->points += 3;

                    $guest_team->lose++;
                    $guest_team->goal_differential += $guest_team_goals - $home_team_goals;

                    break;
                case 0:
                    $home_team->draws++;
                    $guest_team->draws++;
                    $home_team->points += 1;
                    $guest_team->points += 1;

                    break;
                case -1:
                    $home_team->lose++;
                    $guest_team->win++;
                    $guest_team->points += 3;

                    break;
            }

            $home_team->games++;
            $guest_team->games++;

            $home_team->save();
            $guest_team->save();

        }
    }

    /**
     * @param array $options
     */
    public function makeMatch(array $options = [])
    {
        // to do better
        $matcheModel = new MatcheModel();

        $matcheModel->home_team_id = $options['home_team_id'] ?? null;
        $matcheModel->guest_team_id = $options['guest_team_id'] ?? null;
        $matcheModel->goal_home_team = $options['goal_home_team'] ?? null;
        $matcheModel->goal_guest_team = $options['goal_guest_team'] ?? null;
        $matcheModel->schedule_week = $options['schedule_week'] ?? null;

        $matcheModel->save();
    }

    /**
     * @return mixed
     */
    public function getTeams()
    {
        return TeamModel::orderBy('points', 'desc')->get();
    }

    /**
     * @param int $week
     * @return array
     */
    public function getMatches(int $week = 1)
    {
        return MatcheModel::with(['homeTeam', 'guestTeam'])->where('schedule_week', '=', $week)->limit(2)->get()->toArray();
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\MatcheModel;
use App\Models\TeamModel;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

/**
 * Class FootballController
 * @package App\Http\Controllers
 */
class FootballController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $gameService;

    /**
     * FootballController constructor.
     */
    public function __construct()
    {
        $this->gameService = resolve(GameService::class);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('football.index', [
            'count_weeks' => MatcheModel::GAMES_COUNT
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function match(Request $request)
    {
        $current_week = $request->get('current_week');

        if($current_week < MatcheModel::GAMES_COUNT){

            $this->gameService->play($current_week);

            $teams = $this->gameService->getTeams();
            $matches = $this->gameService->getMatches($current_week);

            $view = View::make('football.table', compact('teams', 'current_week', 'matches'))->render();

            return response()->json([$view]);
        }else{
            return null;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(Request $request)
    {
        $current_week = $request->get('current_week');
        $view = '';

        while($current_week < MatcheModel::GAMES_COUNT){

            $this->gameService->play($current_week);

            $teams = $this->gameService->getTeams();
            $matches = $this->gameService->getMatches($current_week);

            $view .= View::make('football.table', compact('teams', 'current_week', 'matches'))->render();
            $current_week++;
        }

        return response()->json([$view]);
    }

    /**
     * clear data
     */
    public function clear()
    {
        MatcheModel::truncate();

        TeamModel::query()->update([
            'points' => 0,
            'games' => 0,
            'win' => 0,
            'draws' => 0,
            'lose' => 0,
            'goal_differential' => 0,
        ]);
    }
}
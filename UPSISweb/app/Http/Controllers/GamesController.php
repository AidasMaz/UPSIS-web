<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Game;
use App\Models\GameCategory;
use DB;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::orderBy('title')->get();
        foreach($games as $game)
        {
            $game['categories'] = DB::table('game_categories')->where('game_id', $game->id)->get();
        }

        return view('games.index')->with(array('games' => $games));
    }
}

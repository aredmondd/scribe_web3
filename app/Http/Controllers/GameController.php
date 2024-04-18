<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Auth;
use App\Models\Game;

class GameController extends Controller
{

    public function store() {
        //validate data
        request()->validate([
            'name' => 'required|max:255',
            'length' => 'required|numeric|max:999', 
            'owned' => 'required',
            'cost' => 'max:999',
            'platform' => 'required',
        ]);


        $owned = request('owned');
        $cost = request('cost');
        if ($owned == "Y" or $owned == "y" or $owned == "YES" or $owned == "Yes" or $owned == "yes"){
            $owned = 1;
            $cost = null;
        }
        elseif ($owned == "N" or $owned == "n" or $owned == "NO" or $owned == "No" or $owned == "no"){
            $owned = 0;
        }
        else {
            $owned = 100;
        }

        $user = auth()->user();
        $user->Game()->create([
            'name' => request('name'),
            'est_length' => request('length'),
            'is_owned' => $owned,
            'platform' => request('platform'),
            'cost' => $cost,
            'why' => request('why')
        ]);

        return redirect('/all_games');
    }

    public function index(Request $request) {
        $user = auth()->user();
        $games = $user->Game;

        if (request()->input("search") != null) {
            $search = $request->input('search');
            $userId = auth()->user()->id;

            $userGames = Game::where('user_id', $userId)
                            ->where(function($query) use ($search) {
                                $query->where('name', 'like', "%$search%")
                                    ->orWhere('why', 'like', "%$search%");
                            })
                            ->get();

            return view('all_games', ['games' => $userGames, "title_text" => "Backlog"]);
        }

        return view('all_games', [ "games" => $games, "title_text" => "Backlog"]);
    }

    public function stats() {
        $user = auth()->user();
        $games = $user->Game;

        $numCompleted = 0; 
        $hoursPlayed = 0;
        $numDropped = 0;
        $successRate = 0;

        foreach ($games as $game) {
            if ($game->date_finished) {
                $numCompleted++;
                $hoursPlayed += $game->hours_played;
            }
            if ($game->date_dropped) {
                $numDropped++;
            }
        }

        if ($numCompleted == 0 and $numDropped == 0) {
            $successRate = 0;
        }
        else {
            $successRate = $numCompleted / ($numCompleted + $numDropped);
        }

        return view('stats', ["games" => $games, "numComplete" => $numCompleted, "hoursPlayed" => $hoursPlayed, "numDropped" => $numDropped ,"successRate" => $successRate]);
    }

    public function gameUpdate(Request $request) {
        $path = $request->path();
        $gameID = substr($path, strrpos($path, '/') + 1);

        $user = auth()->user();
        $games = $user->Game;

        $currentGame = Game::where("id", $gameID)
                            ->where("user_id", $user->id)
                            ->first();

        if ($currentGame == null) {
            abort(403);
        }

        return view('game', ["currentGame" => $currentGame]);
    }

    public function displayGames(Request $request) {
        $path = $request->path();
        $description = substr($path, strrpos($path, '/') + 1);
        $table_column = null;
        $title_text = null;

        switch ($description) {
            case "backlog":
                $table_column = "is_backlogged";
                $title_text = "Backlog";
                break;
            case "currently_playing":
                $table_column = "is_currently_playing";
                $title_text = "Currently Playing";
                break;
            case "dropped":
                $table_column = "is_dropped";
                $title_text = "Dropped";
                break;
            case "shelved":
                $table_column = "is_shelved";
                $title_text = "Shelved";
                break;
            case "beat":
                $table_column = "is_beat";
                $title_text = "Beat";
                break;
        }

        if ($table_column == null) {
            abort(404);
        }

        $user = auth()->user();
        $games = $user->Game;

        $filteredGames = Game::where($table_column, 1)->get();
        
        return view('all_games', [ "games" => $filteredGames, "title_text" => $title_text]);
    }
}

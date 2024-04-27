<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Auth;
use App\Models\Game;

class GameController extends Controller
{
    /**
    * STORE
    *
    * Adds a game to the database based on the user's inputs.
    */
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

        // add data to database
        $user = auth()->user();
        $user->Game()->create([
            'name' => request('name'),
            'est_length' => request('length'),
            'is_owned' => $owned,
            'platform' => request('platform'),
            'cost' => $cost,
            'why' => request('why')
        ]);

        return redirect('/games/backlog');
    }

    /**
     * DESTROY
     * 
     * Deletes a user's game from the database
     * @param Request $request The URL information
     */
    public function destroy(Request $request) {
        $id = $request->route()->parameters["id"];
        $game = Game::find($id);
        $game->delete();
        return redirect()->back();
    }

    /**
    * INDEX
    *
    * Adds a game to the database based on the user's inputs.
    * @param Request $request The URL information
    */
    // public function index(Request $request) {
    //     dd("index");
    //     $user = auth()->user();
    //     $games = $user->Game;

    //     if (request()->input("search") != null) {
    //         $search = $request->input('search');
    //         $userId = auth()->user()->id;

    //         $userGames = Game::where('user_id', $userId)
    //                         ->where(function($query) use ($search) {
    //                             $query->where('name', 'like', "%$search%")
    //                                 ->orWhere('why', 'like', "%$search%");
    //                         })
    //                         ->get();

    //         return view('games', ['games' => $userGames, "title_text" => "All Games"]);
    //     }

    //     return view('games', [ "games" => $games, "title_text" => "All Games"]);
    // }

    /**
    * STATS
    *
    * Loads and displays user stats on stats.blade.php
    */
    public function stats() {
        $user = auth()->user();
        $games = $user->Game;

        $numCompleted = 0; 
        $hoursPlayed = 0;
        $numDropped = 0;
        $successRate = 0;

        foreach ($games as $game) {
            if ($game->is_beat) {
                $numCompleted++;
                $hoursPlayed += $game->est_length;
            }
            if ($game->is_dropped) {
                $numDropped++;
            }
        }

        if ($numCompleted == 0 and $numDropped == 0) {
            $successRate = 0;
        }
        else {
            $successRate = ($numCompleted / ($numCompleted + $numDropped) * 100);
        }

        return view('stats', ["games" => $games, "numComplete" => $numCompleted, "hoursPlayed" => $hoursPlayed, "numDropped" => $numDropped ,"successRate" => $successRate]);
    }

    /**
     * DISPLAYGAMES
     * 
     * Displays games on multiple pages depending on which filters are selected
     * @param Request $request The URL information
     */
    public function displayGames(Request $request) {
        // for aesthetic purposes and display on the games.blade.php page
        if (isset($request->route()->parameters["desc"])) {
            $description = $request->route()->parameters["desc"];
        }
        else {
            $description = "backlog";
        }
        $table_column = null;
        $title_text = null;
        $current_location = null;

        $translations = $this->translate($description);

        // prevent users from breaking the website with typos in the URL
        if ($translations == null) {
            abort(404);
        }

        // update the variables based on the translations above.
        $table_column = $translations["table_column"];
        $title_text = $translations["title_text"];
        $current_location = $translations["current_location"];

        // get all the games based on table_column
        $user = auth()->user();
        $games = $user->Game;
        $filteredGames = Game::where($table_column, 1)->get();
        
        return view('games', [ "games" => $filteredGames, "title_text" => $title_text, "current_location" => $current_location]);
    }

    /**
     * UPDATE
     * 
     * Updates games from Backlog to Currently Playing
     * Updates games from Currently Playing to Dropped/Shelved/Beat
     * @param Request $request The URL information
     */
    public function update(Request $request) {
        // find the game based on ID in the URL
        $id = $request->route()->parameters["id"];
        $game = Game::find($id);

        // moving from backlog to currently playing
        if ($game->is_backlogged) {
            $game->is_backlogged = 0;
            $game->is_currently_playing = 1;
        }

        // moving from currently playing to final three. //TODO this will need to be updated once the user can select their own data
        else if ($game->is_currently_playing) {
            $game->is_currently_playing = 0;
            $game->is_beat = 1;
        }

        $game->save();
        return redirect()->back();
    }

    /**
     * SORT
     * 
     * Sorts games on any given page based on parameter and filters
     * e.g: Sort my backlogged games by Name
     */
    public function sort(Request $request) {
        // figure out what to sort by
        $sortby = $request->route()->parameters["sortby_field"];
        $sortby_column = null;

        // figure out what we are sorting by
        switch($sortby) {
            case "name":
                $sortby_column = "name";
                break;
            case "length":
                $sortby_column = "est_length"; //TODO should update to "hours_played" after users can enter that sort of thing
                break;
            case "owned":
                $sortby_column = "is_owned";
                break;
            case "platform":
                $sortby_column = "platform";
                break;
            case "cost":
                $sortby_column = "cost";
                break;
        }

        // if we didn't update the sort_by column variable, the user edited the URL to attempt to acces a non-valid sortby type. exit.
        if ($sortby_column == null) {
            abort(404);
        }

        // for aesthetic purposes and display on the games.blade.php page
        $description = $request->route()->parameters["desc"];
        $table_column = null;
        $title_text = null;
        $current_location = null;

        $translations = $this->translate($description);

        // prevent users from breaking the website with typos in the URL
        if ($translations == null) {
            abort(404);
        }

        // update the variables based on the translations above.
        $table_column = $translations["table_column"];
        $title_text = $translations["title_text"];
        $current_location = $translations["current_location"];

        // get games based on current button (backlog, currently playing, etc.)
        $user = auth()->user();
        $games = $user->Game;
        $filteredGames = Game::where($table_column, 1)->get();

        // sort the games that are under the current button
        $sortedFilteredGames = $filteredGames->sortByDesc($sortby_column); 

        return view('games', [ "games" => $sortedFilteredGames, "title_text" => $title_text, "current_location" => $current_location]);
    }

    /**
     * TRANSLATE
     * 
     * "Translates" the URL into readable formats for the front & back-end.
     * 
     * e.g: if the current URL is /games/backlog... we want to
     * 
     * Display "Backlog" on the front-end
     * Search "is_backlogged" == 1 on the backend.
     */
    private function translate(string $description) {
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

        if ($table_column == null or $title_text == null) {
            return null;
        }

        return ["table_column" => $table_column, "title_text" => $title_text, "current_location" => $description];
    }

    // public function gameUpdate(Request $request) {
    //     $path = $request->path();
    //     $gameID = substr($path, strrpos($path, '/') + 1);

    //     $user = auth()->user();
    //     $games = $user->Game;

    //     $currentGame = Game::where("id", $gameID)
    //                         ->where("user_id", $user->id)
    //                         ->first();

    //     if ($currentGame == null) {
    //         abort(403);
    //     }

    //     return view('game', ["currentGame" => $currentGame]);
    // }
}
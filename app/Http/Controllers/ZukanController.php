<?php

namespace App\Http\Controllers;

use App\Models\Character;

use App\Models\CharacterImage;

use App\Models\Season;

use App\Models\Tribe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZukanController extends Controller
{
    /**
     * キャラクター図鑑をHTMLで出力
     *
     * @return view
     */
    public function dragonball_zukan()
    {
        $characters = DB::table("characters")
            ->leftjoin("seasons", "characters.season_id", "=", "seasons.id")
            ->leftjoin("tribes", "characters.tribe_id", "=", "tribes.id")
            ->select("characters.*", "seasons.name as season_name", "tribes.name as tribe_name")
            ->whereNull("characters.deleted_at")
            ->get();

        foreach ($characters as $character) {
            $character->image = CharacterImage::where("character_id", $character->id)->whereNull("deleted_at")->get();

            if ($character->image->isEmpty()) {
                $character->image_path = asset("/storage/img/noimage.png");
            }
            if (!$character->image->isEmpty()) {
                $character->image_path = asset($character->image[0]->image_path);
            }
        }
        return view("/dragonball_zukan", compact("characters"));
    }


    public function character_detail(Request $request)
    {
        $character = DB::table("characters")
            ->leftjoin("seasons", "characters.season_id", "=", "seasons.id")
            ->leftjoin("tribes", "characters.tribe_id", "=", "tribes.id")
            ->select("characters.*", "seasons.name as season_name", "tribes.name as tribe_name")
            ->where("characters.id", "=", $request->id)
            ->first();

        $seasons = Season::whereNull("deleted_at")->get();
        $tribes = Tribe::whereNull("deleted_at")->get();

        $character->image = CharacterImage::select("image_path")->where("character_id", $request->id)->whereNull("deleted_at")->get();

        foreach ($character->image as $images) {
            $character->image_path[] = $images->image_path;
        }

        return view("character_detail", compact("character", "seasons", "tribes"));
    }
}

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
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }


    /**
     * キャラクター図鑑をHTMLで出力（検索あり）
     *
     * @return view
     */
    public function dragonball_zukan(Request $request)
    {
        $seasons = Season::whereNull("deleted_at")->get();
        $tribes = Tribe::whereNull("deleted_at")->get();

        
        $seasonId = $request->season;
        $tribeId = $request->tribe;
        $keyword = $request->input("keyword");

        $characters = Character::whereNull("deleted_at")
            ->when(!empty($seasonId), function ($query) use ($seasonId) {
                return $query->whereIn("season_id", $seasonId);
            })
            ->when(!empty($tribeId), function ($query) use ($tribeId) {
                return $query->whereIn("tribe_id", $tribeId);
            })
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where("name", "like", "%" . self::escapeLike($keyword) . "%");
            })
            ->orderBy("season_id", "asc")
            ->get();

            

        if (!empty($characters)) {
            session()->flash("seasonId", $seasonId);
            session()->flash("tribeId", $tribeId);
            session()->flash("keyword", $keyword);

            foreach ($characters as $character) {
                $character->image = CharacterImage::where("character_id", $character->id)->whereNull("deleted_at")->get();

                if ($character->image->isEmpty()) {
                    $character->image_path = asset("/storage/img/noimage.png");
                }
                if (!$character->image->isEmpty()) {
                    $character->image_path = asset($character->image[0]->image_path);
                }
            }
            return view("/dragonball_zukan", compact("characters", "seasons", "tribes"));
        }

        
        // 検索なし
        // $characters = DB::table("characters")
        //     ->leftjoin("seasons", "characters.season_id", "=", "seasons.id")
        //     ->leftjoin("tribes", "characters.tribe_id", "=", "tribes.id")
        //     ->select("characters.*", "seasons.name as season_name", "tribes.name as tribe_name")
        //     ->whereNull("characters.deleted_at")
        //     ->get();


        // foreach ($characters as $character) {
        //     $character->image = CharacterImage::where("character_id", $character->id)->whereNull("deleted_at")->get();

        //     if ($character->image->isEmpty()) {
        //         $character->image_path = asset("/storage/img/noimage.png");
        //     }
        //     if (!$character->image->isEmpty()) {
        //         $character->image_path = asset($character->image[0]->image_path);
        //     }
        // }
        // return view("/dragonball_zukan", compact("characters", "seasons", "tribes"));
    }


    /**
     * キャラクターの詳細画面をHTMLで出力
     *
     * @param Request $request
     * @return view
     */
    public function character_detail(Request $request)
    {
        $seasons = Season::whereNull("deleted_at")->get();
        $tribes = Tribe::whereNull("deleted_at")->get();
        $character = DB::table("characters")
            ->leftjoin("seasons", "characters.season_id", "=", "seasons.id")
            ->leftjoin("tribes", "characters.tribe_id", "=", "tribes.id")
            ->select("characters.*", "seasons.name as season_name", "tribes.name as tribe_name")
            ->where("characters.id", "=", $request->id)
            ->first();

        if (empty($character->height)) {
            $character->height = "？";
        }
        if (empty($character->weight)) {
            $character->weight = "？";
        }


        $character->image = CharacterImage::select("image_path")->where("character_id", $request->id)->whereNull("deleted_at")->get();

        if ($character->image->isEmpty()) {
            $character->image_path[] = asset("/storage/img/noimage.png");
        }

        foreach ($character->image as $images) {
            $character->image_path[] = $images->image_path;
        }

        return view("character_detail", compact("character", "seasons", "tribes"));
    }
}

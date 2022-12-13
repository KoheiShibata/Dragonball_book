<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Character;

use App\Models\CharacterImage;

use App\Models\Season;

use App\Models\Tribe;
use Illuminate\Support\Facades\DB;

class CharacterController extends Controller
{
    /**
     * キャラクター新規登録をHTMLで出力
     *
     * @return view
     */
    public function character_create()
    {
        $seasons = Season::whereNull("deleted_at")->get();

        $tribes = Tribe::whereNull("deleted_at")->get();

        return view("/character_create", compact("seasons", "tribes"));
    }


    /**
     * キャラクターを新規登録
     *
     * @param Request $request
     * @return reidrect
     */
    public function character_register(Request $request)
    {
        
        $param = Character::create([
            "name" => $request->name,
            "content" => $request->content,
            "height" => $request->height,
            "weight" => $request->weight,
            "tribe_id" => $request->tribe_id,
            "season_id" => $request->season_id,
            "attack" => $request->attack,
            "defense" => $request->defense,
            "ability" => $request->ability,
            "popularity" => $request->popularity,
        ]);

        $character_id = $param->id;

        $files = [];
        $files = $request->image;
        $filePath = [];


        if (!$files == []) {
            foreach ($files as $file) {
                preg_match('/data:image\/(\w+);base64,/', $file, $matches);
                $extension = $matches[1];

                $img = preg_replace('/^data:image.*base64,/', "", $file);
                $img = str_replace(' ', '+', $img);

                $fileName = md5($img);
                $image_path = "/storage/character/" . $fileName . "." . $extension;
                file_put_contents(".".$image_path, base64_decode($img));
                $filePath[] = "/storage/character/" . $fileName . "." . $extension;

                CharacterImage::create([
                    "character_id" => $character_id,
                    "image_path" => $image_path,
                ]);
            }
        }
        return redirect("character_list");
    }


    /**
     * キャラクター一覧をHTMLで出力
     *
     * @return void
     */
    public function character_list() 
    {
        $characters = DB::table("characters")
            ->leftjoin("seasons", "characters.season_id", "=", "seasons.id")
            ->leftjoin("tribes", "characters.tribe_id", "=", "tribes.id")
            ->select("characters.*", "seasons.name as season_name", "tribes.name as tribe_name")
            ->whereNull("characters.deleted_at")
            ->get();

        foreach($characters as $character) {
            $character->image = CharacterImage::where("character_id", $character->id)->get();
            if($character->image->isEmpty()) {
                $character->image_path = asset("/storage/img/noimage.png");
            }
            if(!$character->image->isEmpty()) {
                $character->image_path = asset($character->image[0]->image_path);
            }
        }


       
        return view("character_list", compact("characters"));
    }
}

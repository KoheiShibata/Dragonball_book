<?php

namespace App\Http\Controllers;

use App\Models\Character;

use App\Models\CharacterImage;

use App\Models\Season;

use App\Models\Tribe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class ZukanController extends Controller
{
    
    /**
     * ホーム画面をHTMLで出力する
     *
     * @return view
     */
    public function home()
    {
        $seasons = Season::fetchAll();
        return view("/pbook.home", compact("seasons"));
    }


    /**
     * キャラクター図鑑をHTMLで出力
     *
     * @return view
     */
    public function pbook(Request $request)
    {
        try {
            $seasons = Season::fetchAll();
            $tribes = Tribe::fetchAll();
            session()->forget(config("filter.character"));

            $filter = $request->only(config("filter.character"));
            $characters = Character::searchAll($filter);

            foreach ($filter as $key => $sessionData) {
                if ($key !== "keyword" && !(is_array($sessionData))) {
                    continue;
                }
                session()->put($key, $sessionData);
            }

            if ($characters->isNotEmpty()) {
                $characters = $this->formatedCharacterImages($characters);
            }
            return view("/pbook.list", compact("characters", "seasons", "tribes"));
        } catch (\Exception $e) {
            echo $e;
            return abort(404);
        }
    }


    /**
     * キャラクター絞り込み
     *
     * @param Request $request
     * @return JSON
     */
    public function filtering(Request $request)
    {
        session()->forget(config("filter.character"));

        $filter = $request->only(config("filter.character"));
        $characters = Character::searchAll($filter);

        foreach ($filter as $key => $sessionData) {
            if ($key !== "keyword" && !(is_array($sessionData))) {
                continue;
            }
            session()->put($key, $sessionData);
        }

        if ($characters->isNotEmpty()) {
            $characters = $this->formatedCharacterImages($characters);
        }
        return $characters;
    }


    /**
     * キャラクター画像をフォーマット
     *
     * @param [type] $characters
     * @return object
     */
    private function formatedCharacterImages($characters): object
    {
        $selectedCharacterId = [];

        foreach ($characters as $key => $character) {
            $characterImages[$character->id][] = $character->formatedImagePath;
            if (in_array($character->id, $selectedCharacterId)) {
                unset($characters[$key]);
                continue;
            }
            $selectedCharacterId[] = $character->id;
        }
        return $characters;
    }


    /**
     * キャラクターの詳細画面をHTMLで出力
     *
     * @param Request $request
     * @return view
     */
    public function detail($id)
    {
        try {
            if (
                empty($id) ||
                !is_numeric($id) ||
                !Character::isCharacterExists($id)
            ) {
                throw new \Exception();
            }
            $seasons = Season::fetchAll();
            $tribes = Tribe::fetchAll();
            $character = Character::fetchCharacterDataByCharacterId($id);
            $character->image_paths = explode(',', $character->image_paths);
            if (empty($character->image_paths[0])) {
                $character->image_paths = [$character->formatedImagePath];
            }
            return view("/pbook.detail", compact("character", "seasons", "tribes"));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}

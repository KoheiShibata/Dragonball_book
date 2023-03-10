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
     * キャラクター図鑑をHTMLで出力（検索あり）
     *
     * @return view
     */
    public function pbook(Request $request)
    {
        try {

            $selectedCharacterId = [];
            $characterImages = [];
            $seasons = Season::fetchAll();
            $tribes = Tribe::fetchAll();

            $filter = $request->only(config("filter.character"));

            $characters = Character::searchAll($filter);
            foreach ($filter as $key => $sessionData) {
                if ($key !== "keyword" && !(is_array($sessionData))) {
                    continue;
                }
                session()->flash($key, $sessionData);
            }

            if ($characters->isNotEmpty()) {
                foreach ($characters as $key => $character) {
                    $characterImages[$character->id][] = $character->formatedImagePath;
                    if (in_array($character->id, $selectedCharacterId)) {
                        unset($characters[$key]);
                        continue;
                    }
                    $selectedCharacterId[] = $character->id;
                }
            }
            return view("/pbook.list", compact("characters", "characterImages", "seasons", "tribes"));
        } catch (\Exception $e) {
            return abort(404);
        }
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
            $characterImages = $characterImages = CharacterImage::fetchImage($id);

            foreach ($characterImages as $path) {
                $characterImage[] = $path->formatedImagePath;
            }
            return view("/pbook.detail", compact("character", "characterImage", "seasons", "tribes"));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

}

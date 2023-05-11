<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Character;
use App\Models\CharacterImage;
use App\Models\Season;
use App\Models\Tribe;
use Illuminate\Support\Str;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class CharacterController extends Controller
{

    /**
     * キャラクター新規登録画面をHTMLで出力
     *
     * @return view
     */
    public function create()
    {
        $seasons = Season::fetchAll();
        $tribes = Tribe::fetchAll();

        return view("/character.form", compact("seasons", "tribes"));
    }

    /**
     * キャラクターを新規登録
     *
     * @param Request $request
     * @return reidrect
     */
    public function store(Request $request)
    {

        try {
            $param = $request->validate(config(CHARACTER_REGISTRATION_VALIDATE));

            DB::beginTransaction();
            $characterId = Character::create($param)->id;
            $files = $request->image;

            //　画像がpostされたときはアップロードした後、インサート用にフォーマット 
            if (!empty($imagesPath = $this->imageUpload($files))) {
                $this->imageInsert($imagesPath, $characterId);
            }

            DB::commit();
            return [SUCCESS_MESSAGE => REGISTRATION_SUCCESS_MESSAGE];
        } catch (\Exception $e) {
            DB::rollback();
            return [ERROR_MESSAGE => REGISTRATION_FAILED_MESSAGE];
        }
    }

    /**
     * キャラクター一覧をHTMLで出力
     *
     * @return view
     */
    public function index()
    {
        if (empty(session("seasonId")) && empty(session("tribeId"))) {
            session()->push("seasonId", "");
            session()->push("tribeId", "");
        }
        $characters = Character::fetchAll();
        $seasons = Season::fetchAll();
        $tribes = Tribe::fetchAll();
        session()->forget(config("filter.character"));

        foreach ($characters as $key => $character) {
            if (!in_array($character->season_id, session("seasonId"))) {
                session()->push("seasonId", $character->season_id);
            }
            if (!in_array($character->tribe_id, session("tribeId"))) {
                session()->push("tribeId", $character->tribe_id);
            }

            $character->height = $character->formatedHeight;
            $character->weight = $character->formatedWeight;
            $character->content = nl2br($character->content);
            $character->image_path = $character->formated_image_path;
            if (empty($character->image_paths[0])) {
                $character->image_paths = [$character->formated_image_path];
                continue;
            }
            $character->image_paths = explode(',', $character->image_paths);
        }
        return view("character.index", compact("characters", "seasons", "tribes"));
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
        $characters = Character::fetchFilteringCharacterData($filter);

        foreach ($filter as $key => $sessionData) {
            if ($key !== "keyword" && !(is_array($sessionData))) {
                continue;
            }
            session()->put($key, $sessionData);
        }

        if ($characters->isNotEmpty()) {
            $characters = $this->formatedCharacterData($characters);
        }
        return $characters;
    }

    /**
     * キャラクター編集画面をHTMLで出力
     *
     * @param Request $request
     * @return view
     */
    public function edit($id)
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
            return view("character.edit", compact("character", "seasons", "tribes"));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    /**
     * キャラクターの情報を更新する
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        try {
            $characterId = $request->id;
            $files = $request->image;
            $param = $request->validate(config(CHARACTER_UPDATE_VALIDATE));

            DB::beginTransaction();
            Character::updateExecution($param);
            CharacterImage::deleteImageRow($characterId);

            // 画像の変更があった場合はアップロード・インサート
            if (!empty($imagesPath = $this->imageUpload($files))) {
                $this->imageInsert($imagesPath, $characterId);
            }

            DB::commit();
            return [SUCCESS_MESSAGE => UPDATE_SUCCESS_MESSAGE];
        } catch (\Exception $e) {
            DB::rollBack();
            return [ERROR_MESSAGE => UPDATE_FAILED_MESSAGE];
        }
    }

    /**
     * キャラクターを削除する
     *
     * @param Request $request
     * @return redirect
     */
    public function destory($id)
    {
        try {
            if (
                empty($id) ||
                !is_numeric($id)
            ) {
                throw new \Exception();
            }
            Character::deleteRow($id);
            return redirect(CHARACTER_TOP)->with(SUCCESS_MESSAGE, DELETE_SUCCESS_MESSAGE);
        } catch (\Exception $e) {
            return redirect(CHARACTER_TOP)->with(ERROR_MESSAGE, DELETE_FAILED_MESSAGE);
        }
    }

    /**
     * 画像アップロード処理
     *
     * @param array|null $files
     * @return array
     */
    private function imageUpload($files): array
    {
        $res = [];
        if (empty($files)) {
            return [];
        }

        foreach ($files as $file) {
            // 編集で変更しなかった画像パスを取得
            if (!preg_match('/data:image\/(\w+);base64,/', $file)) {

                $imagePath = strstr($file, "/storage");
                $res[] = $imagePath;
                continue;
            }

            // base64をデコード
            preg_match('/data:image\/(\w+);base64,/', $file, $matches);
            $extension = $matches[1];

            $img = preg_replace('/^data:image.*?base64,/', "", $file);
            $img = str_replace(' ', '+', $img);
            $fileName = md5($img);
            $imagePath = "/storage/character/" . $fileName . "." . $extension;
            file_put_contents("." . $imagePath, base64_decode($img));
            $res[] = $imagePath;
        }
        return $res;
    }

    /**
     * 画像パスをインサート
     *
     * @param array $imagePaths
     * @param integer $characterId
     * @return void
     */
    private function imageInsert(array $imagePaths, int $characterId)
    {
        $characterImageInsertParam = [];
        foreach ($imagePaths as $path) {
            $characterImageInsertParam[] = [
                "character_id" => $characterId,
                "image_path" => $path
            ];
        }
        CharacterImage::insert($characterImageInsertParam);
    }

    /**
     * キャラクターデータをフォーマット
     *
     * @param [type] $characters
     * @return object
     */
    private function formatedCharacterData($characters): object
    {
        foreach ($characters as $character) {
            $character->height = $character->formatedHeight;
            $character->weight = $character->formatedWeight;
            $character->content = nl2br($character->content);
            $character->image_path = $character->formated_image_path;

            if (empty($character->image_paths[0])) {
                $character->image_paths = [$character->formated_image_path];
                continue;
            }
            $character->image_paths = explode(',', $character->image_paths);
        }
        return $characters;
    }
}

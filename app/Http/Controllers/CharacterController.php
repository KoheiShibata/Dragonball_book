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
    public function createForm()
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
    public function create(Request $request)
    {

        try {
            $param = $request->validate(config(CHARACTER_REGISTRATION_VALIDATE));

            DB::beginTransaction();
            $characterId = Character::create($param)->id;
            $files = $request->image;

            //　画像がpostされたときはアップロードした後、インサート用にフォーマット 
            if (!empty($imagesPath = $this->imageUpload($files))) {
                $characterImageInsertParam = [];
                foreach ($imagesPath as $path) {
                    $characterImageInsertParam[] = [
                        "character_id" => $characterId,
                        "image_path" => $path
                    ];
                }
                CharacterImage::insert($characterImageInsertParam);
            }
            DB::commit();
            return [SUCCESS_MESSAGE => REGISTRATION_SUCCESS_MESSAGE];
        } catch (\Exception $e) {
            DB::rollback();
            return [ERROR_MESSAGE => REGISTRATION_FAILED_MESSAGE];
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

                $file = strstr($file, "/storage");
                $res[] = $file;
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
     * キャラクター一覧をHTMLで出力
     *
     * @return view
     */
    public function characterList()
    {
        $selectedCharacterId = [];
        $characterImages = [];
        if (empty(session("seasonId")) && empty(session("tribeId"))) {
            session()->push("seasonId", "");
            session()->push("tribeId", "");
        }
        $characters = Character::fetchAll();

        foreach ($characters as $key => $character) {
            if (!in_array($character->season_id, session("seasonId"))) {
                session()->push("seasonId", $character->season_id);
            }
            if (!in_array($character->tribe_id, session("tribeId"))) {
                session()->push("tribeId", $character->tribe_id);
            }

            $character->height = $character->formatedHeight;
            $character->weight = $character->formatedWeight;
            $characterImages[$character->id][] = $character->formatedImagePath;
            if (in_array($character->id, $selectedCharacterId)) {
                unset($characters[$key]);
                continue;
            }
            $selectedCharacterId[] = $character->id;
        }

        return view("character.list", compact("characters", "characterImages"));
    }


    /**
     * キャラクター編集画面をHTMLで出力
     *
     * @param Request $request
     * @return view
     */
    public function characterDetail($id)
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
            $characterImages = CharacterImage::fetchImage($id);
            foreach ($characterImages as $image) {
                $characterImage[] = $image->image_path;
            }
            return view("character.edit", compact("character", "characterImage", "seasons", "tribes"));
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
    public function edit(Request $request)
    {
        try {
            $characterId = $request->id;
            $param = $request->validate(config(CHARACTER_UPDATE_VALIDATE));

            DB::beginTransaction();
            Character::updateExecution($param);
            CharacterImage::deleteImageRow($characterId);

            $files = $request->image;
            if (!empty($imagesPath = $this->imageUpload($files))) {
                $characterImageInsertParam = [];
                foreach ($imagesPath as $path) {
                    $characterImageInsertParam[] = [
                        "character_id" => $characterId,
                        "image_path" => $path
                    ];
                }
                CharacterImage::insert($characterImageInsertParam);
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
    public function delete($id)
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


    public function characterData($token)
    {
        if ($token !== env("ACCESS_TOKEN")) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $characterData = Character::fetchAllbyApi();

        return response()->json($characterData);
    }
}

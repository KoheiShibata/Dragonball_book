<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Character;

use App\Models\CharacterImage;

use App\Models\Season;

use App\Models\Tribe;
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

        return view("character.form", compact("seasons", "tribes"));
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

            // 画像がPOSTされたきた際はアップロードした後、インサート用にフォーマット
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
    private function imageUpload($files):array
    {
        $res = [];
        if (empty($files)) {
            return [];
        }
        foreach ($files as $file) {
            preg_match('/data:image\/(\w+);base64,/', $file, $matches);
            $extension = $matches[1];

            $img = preg_replace('/^data:image.*base64,/', "", $file);
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

        $characters = Character::fetchAll();

        foreach ($characters as $key => $character) {
            $characterImages[$character->id][] = $character->formated_image_path;
            if (in_array($character->id, $selectedCharacterId)) {
                unset($characters[$key]);
                continue;
            }
            $selectedCharacterId[] = $character->id;
        }
        return view("character_list", compact("characters", "characterImages"));
    }


    /**
     * キャラクター編集画面をHTMLで出力
     *
     * @param Request $request
     * @return view
     */
    public function edit(Request $request)
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

        return view("character_edit", compact("character", "seasons", "tribes"));
    }


    /**
     * キャラクターの情報を更新する
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $character = Character::where("id", "=", $request->id)->first();
        // 更新した値を代入
        $character->name = $request->name;
        $character->content = $request->content;
        $character->height = $request->height;
        $character->weight = $request->weight;
        $character->tribe_id = $request->tribe_id;
        $character->season_id = $request->season_id;
        $character->attack = $request->attack;
        $character->defense = $request->defense;
        $character->ability = $request->ability;
        $character->popularity = $request->popularity;

        // 画像以外の情報を更新
        $character->save();
        
        // 画像の処理
        $files = [];
        $files = $request->image;
        $filePath = [];
        
        // 選択されたidのキャラクタ―画像を削除する
        $character->character_images()->delete();

        if (!$files == []) {
            foreach ($files as $file) {
                // base64形式以外の画像がrequestされた場合
                if(!preg_match('/data:image\/(\w+);base64,/', $file)) {
                    // /storageより前の文字列を削除する
                    $file = strstr($file, "/storage");
                    $image_path = $file;
                }

                //base64形式で画像がrequestされた時 
                if(preg_match('/data:image\/(\w+);base64,/', $file)) {
                    preg_match('/data:image\/(\w+);base64,/', $file, $matches);
                    $extension = $matches[1];
    
                    $img = preg_replace('/^data:image.*base64,/', "", $file);
                    $img = str_replace(' ', '+', $img);
    
                    $fileName = md5($img);
                    $image_path = "/storage/character/" . $fileName . "." . $extension;
                    file_put_contents("." . $image_path, base64_decode($img));
                    $filePath[] = "/storage/character/" . $fileName . "." . $extension;
                }
                CharacterImage::create([
                    "character_id" => $request->id,
                    "image_path" => $image_path,
                ]);
            }
        }
        
    }


    /**
     * キャラクターを削除する
     *
     * @param Request $request
     * @return redirect
     */
    public function delete(Request $request)
    {
        $character = Character::find($request->id);
        $character->delete();

        return redirect(CHARACTER_TOP);
    }
}

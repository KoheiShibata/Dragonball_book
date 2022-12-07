<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Character;

use App\Models\Season;

use App\Models\Tribe;

class CharacterController extends Controller
{

    private function imageUpload($image) {
        $file_name = $image->getClientOriginalName();
        $path = $image->storeAS("public/img", date("YmdHis")."-".$file_name);
        $image_path = date("YmdHis")."-".$file_name;
        return $image_path;
    } 


    /**
     * キャラクター新規登録をHTMLで出力
     *
     * @return view
     */
    public function characters() {
        $seasons = Season::whereNull("deleted_at")->get();

        $tribes = Tribe::whereNull("deleted_at")->get();

        return view("/character_create", compact("seasons", "tribes"));

    }



}

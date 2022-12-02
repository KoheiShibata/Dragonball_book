<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Character;

class CharacterController extends Controller
{
    /**
     * キャラクター新規登録をHTMLで出力
     *
     * @return view
     */
    public function character_create() {

        return view("/character_create");

    }



}

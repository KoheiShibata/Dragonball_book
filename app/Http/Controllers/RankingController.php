<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Character;
use App\Models\Season;
use App\Models\Tribe;
use App\Models\Enquete;
use App\Models\EnqueteAnswer;

class RankingController extends Controller
{

    /**
     * ランキング画面をHTMLで出力
     *
     * @return HTML
     */
    public function index()
    {
        $rankingData = Enquete::fetchRanking();
        $seasons = Season::fetchAll();
        $tribes = Tribe::fetchAll();

        // print_r($rankingData);exit;

        return view("ranking.index", compact("rankingData", "seasons", "tribes"));
        
    }
}

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
        $rankingData = $this->formatRankingData($rankingData);
        $seasons = Season::fetchAll();
        $tribes = Tribe::fetchAll();

        return view("ranking.index", compact("rankingData", "seasons", "tribes"));
    }


    /**
     * rankingDataにランクキングを付与する
     *
     * @param array $rankingData
     * @return array
     */
    private function formatRankingData(array $rankingData): array
    {

        foreach ($rankingData as &$characters) {
            $prevVoteCount = 0;
            $prevRank = 0;
            $this->assignRanking($characters, $prevVoteCount, $prevRank);
        }

        return $rankingData;
    }

    /**
     * charactersにランクを付与する
     *
     * @param array $characters
     * @param int $prevVoteCount
     * @param int $prevRank
     * @return void
     */
    private function assignRanking(array &$characters, int &$prevVoteCount, int &$prevRank): void
    {
        $rank = 1;

        foreach ($characters as &$character) {
            $voteCount = $character->vote_count;

            if ($prevVoteCount != $voteCount) {
                $prevVoteCount = $voteCount;
                $prevRank = $rank;
            }

            $character->rank = $prevRank;

            $rank++;
        }
    }
}

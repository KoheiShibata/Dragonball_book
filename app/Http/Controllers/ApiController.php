<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Character;
use App\Models\Enquete;
use App\Models\EnqueteAnswer;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    /**
     * キャラクターデータをjson形式で返す
     *
     * @param [type] $token
     * @return JSON
     */
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

    /**
     * アンケート質問 & アンケート結果を登録する
     *
     * @param Request $request
     * @param [type] $token
     * @return JSON
     */
    public function store(Request $request, $token)
    {
        try {
            if ($token !== env("ACCESS_TOKEN")) {
                throw new \Exception();
            }
            DB::beginTransaction();
            $enquetes = $request->json()->all();

            // アンケート登録
            $param = Enquete::insertDataByEnquete($enquetes);
            $enqueteResults = EnqueteAnswer::insert($param);

            DB::commit();
            return response()->json($enqueteResults);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Season;
use Hamcrest\Type\IsNumeric;

class SeasonController extends Controller
{

    /**
     * シーズンの新規登録/シーズン一覧をHTMLで出力
     *
     * @return view
     */
    public function index()
    {
        $seasons = Season::fetchAll();
        foreach ($seasons as $season) {
            $season->name = htmlspecialchars($season->name);
        }
        return view("season.index", compact("seasons"));
    }

    /**
     * シーズンを新規登録
     *
     * @param Request $request
     * @return redirect
     */
    public function store(Request $request)
    {
        try {
            $param = $request->validate(config(SEASON_REGISTRATION_VALIDATE));

            if (
                !in_array($param["name"], config(SEASON_LIMITED_VALUE)) ||
                Season::IsSeasonExists($param["name"])
            ) {
                throw new \Exception();
            }
            Season::create($param);
            return redirect(SEASON_TOP)->with(SUCCESS_MESSAGE, REGISTRATION_SUCCESS_MESSAGE);
        } catch (\Exception $e) {
            return redirect(SEASON_TOP)->with(ERROR_MESSAGE, REGISTRATION_FAILED_MESSAGE);
        }
    }

    /**
     * シーズン名を編集する
     *
     * @param Request $request
     * @return red
     */
    public function update(Request $request)
    {
        try {
            $param = $this->validate($request, config(SEASON_UPDATE_VALIDATE));
            
            if (
                !in_array($param["name"], config(SEASON_LIMITED_VALUE)) ||
                Season::IsSeasonExists($param["name"])
            ) {
                throw new \Exception();
            }
            Season::updateRow($param);
            return redirect(SEASON_TOP)->with(SUCCESS_MESSAGE, UPDATE_SUCCESS_MESSAGE);
        } catch (\Exception $e) {
            return redirect(SEASON_TOP)->with(ERROR_MESSAGE, UPDATE_FAILED_MESSAGE);
        }
    }

    /**
     * シーズンを削除する
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
            Season::deleteRow($id);
            return redirect(SEASON_TOP)->with(SUCCESS_MESSAGE, DELETE_SUCCESS_MESSAGE);
        } catch (\Exception $e) {
            return redirect(SEASON_TOP)->with(ERROR_MESSAGE, DELETE_FAILED_MESSAGE);
        }
    }

    /**
     * getパラメーター制御
     *
     * @return abort
     */
    public function getControl()
    {
        return abort(404);
    }
}

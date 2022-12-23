<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Season;

class SeasonController extends Controller
{

    /**
     * シーズンの新規登録をHTMLで出力
     *
     * @return view
     */
    public function seasonList()
    {
        $seasons = Season::fetchAll();

        return view("season.list", compact("seasons"));
    }


    /**
     * シーズンを新規登録
     *
     * @param Request $request
     * @return redirect
     */
    public function create(Request $request)
    {
        try {
            $param = $request->validate(config(SEASON_REGISTRATION_VALIDATE));
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
    public function edit(Request $request)
    {
        try {
            $param = $this->validate($request, config(SEASON_UPDATE_VALIDATE));
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
     * @return 
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
            Season::deleteRow($id);
            return redirect(SEASON_TOP)->with(SUCCESS_MESSAGE, DELETE_SUCCESS_MESSAGE);
        } catch (\Exception $e) {
            return redirect(SEASON_TOP)->with(ERROR_MESSAGE, DELETE_FAILED_MESSAGE);
            
        }
    }
}

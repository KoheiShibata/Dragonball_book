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
    public function seasons() {
        $seasons = Season::whereNull("deleted_at")->get();

        return view("/seasons", compact("seasons"));
    }


    /**
     * シーズンを新規登録
     *
     * @param Request $request
     * @return redirect
     */
    public function season_create(Request $request) {
        echo "test";
        Season::create(["name" => $request->name]);
        return redirect("/seasons")->with("successMessage", "登録が完了しましたg");
    }


    public function edit(Request $request) {
        $season = Season::where("id", "=", $request->id)->first();

        // バリデーション
        $this->validate($request, config("validator.season.edit"));
        $season->name = $request->name;
        $season->save();

        return redirect("/seasons")->with("successMessage", "変更が完了しました");
        
    }

    public function delete(Request $request) {
        Season::find($request->id)->delete();
        return redirect("/seasons")->with("successMessage", "削除に成功しました");

    }
}

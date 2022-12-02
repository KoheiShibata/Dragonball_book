<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tribe;

class TribeController extends Controller
{

    /**
     * 種族の新規登録/種族一覧をHTMLで出力
     *
     * @return view
     */
    public function tribes() {
        $tribes = Tribe::whereNull("deleted_at")->get();
        return view("/tribes", compact("tribes"));
    }


    public function create(Request $request) {
        Tribe::create(["name" => $request->name]);
        return redirect("/tribes");
    }

    public function edit(Request $request) {
        $tribe = Tribe::where("id", "=", $request->id)->first();

        // バリデーション
        $this->validate($request, config("validator.tribe.edit"));
        $tribe->name = $request->name;
        $tribe->save();

        return redirect("/tribes");
    }

    public function delete(Request $request) {
        Tribe::find($request->id)->delete();
    }



}

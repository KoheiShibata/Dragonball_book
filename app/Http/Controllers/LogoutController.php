<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    
    /**
     * ログアウト処理
     *
     * @return redirect
     */
    public function logout()
    {
        session()->forget("admin");

        return redirect("/login");
    }

    /**
     * getパラメータ制御
     *
     * @return abort
     */
    public function getLogout()
    {
        return abort(404);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * ログインフォームをHTMLにて出力
     *
     * @return HTML
     */
    public function loginForm() 
    {
        // ログイン情報が存在する場合はキャラクター管理画面へ
        if(session()->has("admin"))
        {
            return redirect(("/characters"));
        }

        return view("login.index");
    }
}

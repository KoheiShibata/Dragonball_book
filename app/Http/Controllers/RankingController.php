<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Character;
use App\Models\Enquete;
use App\Models\EnqueteAnswer;

class RankingController extends Controller
{
    public function index()
    {
        $data = Enquete::fetchRanking();
        print_r($data);
    }
}

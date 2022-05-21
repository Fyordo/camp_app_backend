<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

class EventReviewsController extends Controller
{
    public function index($time_start, $time_end){
        $time_start = strtotime($time_start);
        $time_end = strtotime($time_end);

        dd($time_start, $time_end);
    }
}

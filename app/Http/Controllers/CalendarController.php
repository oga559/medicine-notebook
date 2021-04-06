<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // 休日データ取得
        $cal = Post::all();
        $tag = $cal->showCalendarTag($request->month,$request->year);
        return view('calendar', ['cal_tag' => $tag]);        
    }
}

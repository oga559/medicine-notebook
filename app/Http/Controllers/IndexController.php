<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Dosing_time;

class IndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $now = Carbon::now();
        $dosing = $user->dosing_time;
        //服用時間が現在時間を超えている服用時間テーブルのデータを取得
        $expired = ($dosing->where('dosing_time', '<', $now)->where('dosing_flag', '1'))->sortBy('dosing_time');
        $history = ($dosing->where('dosing_time', '<', $now)->where('dosing_flag', '0'))->sortBy('dosing_time');
        //まだ服用時間が来ていない服用時間テーブルのデータを取得
        $still = ($dosing->where('dosing_time', '>', $now))->sortBy('dosing_time');
        return view('index',compact('expired','still','history'));
    }
    public function update(Request $request)
    {
        Dosing_time::where('id', $request->id)->update(['dosing_flag' => $request->dosing_flag]);
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        Dosing_time::destroy($request->id);
        return redirect()->back();
    }
}

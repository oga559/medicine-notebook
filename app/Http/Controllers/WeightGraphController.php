<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\WeightLog;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WeightGraphRequest;

class WeightGraphController extends Controller
{
    function index(){
        $user = Auth::id();
        $log = WeightLog::where('user_id',$user)->orderBy('date_key', 'asc')->get();
        //体重を登録していないときは、nullにする
        if($log->isEmpty()){
            $weight_log = null;
            $label = null;
            return view("weight_graph",compact('weight_log','label'));
        }
        foreach($log as $weight){
            $weight_log[] = $weight->weight;
        }
        foreach($log as $date_key){
            $label[] = $date_key->date_key;
        }
        return view("weight_graph",compact('weight_log','label'));
    }
    public function store(WeightGraphRequest $request){
        $weight = $request->all();
        //postリクエストをdbに送信
        WeightLog::create($weight);
        return redirect('graph');
    }
}
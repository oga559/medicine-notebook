<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\WeightLog;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request){
        $this->validate(
            $request,
            [
                'weight' => 'required|integer|digits_between:1,4',
                'date_key'  => 'required|unique:weight_logs,date_key'
            ],
            [
                'weight.required' => '体重を入力してください',
                'weight.integer' => '体重は英数字で入力してください',
                'weight.digits_between' => '体重は4桁以下で入力してください',
                'date_key.required' => '日付を入力してください',
                'date_key.unique' => 'その日付はすでに入力されています'
            ]
        );
        $weight = $request->all();
        //postリクエストをdbに送信
        WeightLog::create($weight);
        return redirect('graph');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Dosing_time;
use Illuminate\Support\Facades\Date;

class DosingController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosing');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'drug_name' => 'required|max:255',
                'dosing_time'  => 'required',
                'note'  => 'max:300'
            ],
            [
                'drug_name.required' => 'お薬名を入力してください',
                'drug_name.max'   => 'お薬名は255文字以下で入力してください',
                'dosing_time.required' => '服用時間を入力してください',
                'note.max'    => 'メモは、300文字以下で入力してください',
            ]
        );
        //リクエストのデータ型がすべてstring型なので、「==」にしてデータ型が判定に反映されないようにした
        if($request->bulk_post==1){
            $now = Carbon::now();
            //exceptでdbに反映しないデータを除外
            $post = $request->except(['_token','bulk_post']);
            //array_merge関数で$postにtimestampsの値を追加
            $post = array_merge($post,array('created_at'=>$now,'updated_at' => $now));
            while($request->bulk_post <= 7){
                Dosing_time::insert($post);
                //これで一週間分まで追加
                $request->bulk_post++;
                //Carbon::parseで文字列を日付に変更
                $add_time = Carbon::parse($post['dosing_time'])->addDay();
                //DBに登録する値に一日足して上書きする
                $post['dosing_time'] = $add_time;
            }
           return redirect('/');
        }
        $post = $request->all();
        //postリクエストをdbに送信
        Dosing_time::create($post);
        return redirect('/');
    }
}

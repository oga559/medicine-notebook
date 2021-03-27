<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Medical_factory;
use Carbon\Carbon;
use App\Post;

class Postcontroller extends Controller
{
    public function create()
    {
        $factory_select = Medical_factory::all();
        return view('create', compact('factory_select'));
    }
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'drug_name' => 'required|max:255',
                'prescription_date'  => 'required',
                'medical_subjects'  => 'max:255',
                'note'  => 'max:300'
            ],
            [
                'drug_name.required' => 'お薬名を入力してください',
                'drug_name.max'   => 'お薬名は255文字以下で入力してください',
                'prescription_date.required'      => '処方日を入力してください',
                'medical_subjects.max'  => '診療科目名は、255文字以下で入力してください',
                'note.max'    => 'メモは、300文字以下で入力してください',
            ]
        );
        //$requestが投稿したデータで、それを受け取っている
        $post = $request->all();
        //postリクエストをdbに送信
        Post::create($post);
        return redirect('/');
    }
}

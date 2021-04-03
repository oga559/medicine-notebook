<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medical_factory;
use App\Photo_post;

class PhotoPostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factory_select = Medical_factory::all();
        return view('photo_create', compact('factory_select'));
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
                'photo' => 'required|file|image',
                'prescription_date'  => 'required',
                'medical_subjects'  => 'max:255',
                'note'  => 'max:300'
            ],
            [
                'photo.required' => '画像を選択して下さい。',
                'photo.file' => '登録する画像はファイルにして下さい。',
                'photo.image' => 'ファイルは画像を選択して下さい',
                'prescription_date.required'      => '処方日を入力してください',
                'medical_subjects.max'  => '診療科目名は、255文字以下で入力してください',
                'note.max'    => 'メモは、300文字以下で入力してください',
            ]
        );
  
        $path = $request->photo->store('public/images');   
        $filename = basename($path);
        //DBに保存
        $member = new Photo_post();
        $member->user_id = $request->user_id;
        $member->medical_factories_id = $request->medical_factories_id;
        $member->medical_subjects = $request->medical_subjects;
        $member->note = $request->note;
        $member->prescription_date = $request->prescription_date;
        $member->photo = $filename;
        $member->save();
        return redirect('/');
    }

}

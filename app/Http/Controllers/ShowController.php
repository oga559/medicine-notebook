<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Post;
use App\Photo_post;
use App\Medical_factory;
use Faker\Provider\Medical;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\AssignOp\Pow;

class ShowController extends Controller
{
    public function show()
    {
      $user = Auth::id();
      $now = Carbon::now();
      $post = Post::where('user_id',$user)->orderBy('prescription_date','asc')->get();
      $photo = Photo_post::where('user_id',$user)->orderBy('prescription_date','asc')->get();
      return view('show',compact('now','post','photo'));
    }
    public function post_edit(Post $post)
    {
      $factory_select = Medical_factory::all();
      return view('post_edit',compact('post','factory_select'));
    }
    public function photo_edit(Photo_post $photo)
    {
      $factory_select = Medical_factory::all();
      $select_change = $photo->photo;
      return view('photo_edit',compact('photo','factory_select','select_change'));
    }
    public function post_update(Request $request)
    {
      $this->validate(
        $request,
        [
            'drug_name' => 'required|max:255',
            'prescription_date'  => 'required',
            'medical_subjects'  => 'max:100',
            'note'  => 'max:300'
        ],
        [
            'drug_name.required' => 'お薬名を入力してください',
            'drug_name.max'   => 'お薬名は255文字以下で入力してください',
            'prescription_date.required'      => '処方日を入力してください',
            'medical_subjects.max'  => '診療科目名は、100文字以下で入力してください',
            'note.max'    => 'メモは、300文字以下で入力してください',
        ]
    );
      $update_post = Post::find($request->id);
      $update_post->fill($request->all())->save();
      return redirect('show');
    }
    public function photo_update(Request $request)
    {
      $this->validate(
        $request,
        [
            'photo' => 'required|file|image',
            'prescription_date'  => 'required',
            'medical_subjects'  => 'max:100',
            'note'  => 'max:300'
        ],
        [
            'photo.required' => '画像を選択して下さい。',
            'photo.file' => '登録する画像はファイルにして下さい。',
            'photo.image' => 'ファイルは画像を選択して下さい',
            'prescription_date.required' => '処方日を入力してください',
            'medical_subjects.max' => '診療科目名は、100文字以下で入力してください',
            'note.max' => 'メモは、300文字以下で入力してください',
        ]
    );
      //削除する画像を取得
      $delPhoto = Photo_post::find($request->id);
      $delFileName = $delPhoto->photo;
      //DBから取得した$delFileNameの名前を利用しストレージに保存した画像を削除
      Storage::delete('public/images/'.$delFileName);
      //また再度DBに保存するために画像をstoreメソッドにかける
      $path = $request->photo->store('public/images');  
      //パスから、最後の「ファイル名.拡張子」の部分だけ取得する[要するにpublic/images/を除いた画像名にする]
      $filename = basename($path);
      //更新したデータをdbに保存する
      $member = Photo_post::find($request->id);
      $member->medical_factory_id = $request->medical_factory_id;
      $member->medical_subjects = $request->medical_subjects;
      $member->note = $request->note;
      $member->prescription_date = $request->prescription_date;
      $member->photo = $filename;
      $member->save();
      return redirect('show');
    }
    public function post_delete(Request $request){
      Post::destroy($request->id);
      return redirect('show');
    }
    public function photo_delete(Request $request){
      $delPhoto = Photo_post::find($request->id);
      $delFileName = $delPhoto->photo;
      Storage::delete('public/images/'.$delFileName);
      Photo_post::destroy($request->id);
      return redirect('show');
    }
}

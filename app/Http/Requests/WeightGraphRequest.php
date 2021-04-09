<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class WeightGraphRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'weight' => 'required|integer|digits_between:1,4',
            'date_key' => [
                'required',
                Rule::unique('weight_logs')->where('date_key',$this->date_key)->where('user_id',Auth::id())
            ],
        ];
    }
    public function messages()
    {
        return [
            'weight.required' => '体重を入力してください',
            'weight.integer' => '体重は英数字で入力してください',
            'weight.digits_between' => '体重は4桁以下で入力してください',
            'date_key.required' => '日付を入力してください',
            'date_key.unique' => 'その日付はすでに入力されています'
        ];
    }
}

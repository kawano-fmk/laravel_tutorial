<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest // 継承します
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function messages()
    {
        return [
            'title.min' => 'タイトルは３文字以上にしてください',
            'title.max' => 'タイトルは30文字以内にしてください',
            'title.required' => 'タイトルを入力してください',
            'content.required' => '本文を入力してください'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:30',
            'content' => 'required'
        ];
    }

    public function authorize()
    {
        //デフォルトではfalseなのでtrueにしないと動作しない。
        return true;
    }

}

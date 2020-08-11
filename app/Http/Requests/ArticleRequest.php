<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:255', //unique データベース内に同じ値がないかチェック
            'tags' => 'required',
            'body' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'タイトルは必ず入力してください',
            'title.max' => '最大文字数は255文字です。',
            'tags.required' => 'タグは最低１つは必ず入力してください',
            'body.required' => '本文は必ず入力してください',
        ];
    }
}

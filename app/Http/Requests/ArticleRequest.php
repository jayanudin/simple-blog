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
            'title' => 'required|unique:articles|max:50|min:5',
            'thumbnail' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|min:5|max:50',
            'content' => 'required|min:5',
            'status' => 'required',
            'category_id' => 'required',
        ];
    }
}

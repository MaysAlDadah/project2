<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
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
            'title'     => 'required|max:200',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'article'      => 'required',
            'category'  => 'required|integer|exists:categories,id',
            'tags'      => 'required'
        ];
    }
}

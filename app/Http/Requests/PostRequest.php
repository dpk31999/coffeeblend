<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string',
            'slug' => 'required|string|unique:posts,slug,' . $this->post->id,
            'url_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
            'keyword' =>'required|string',
            'content' => 'required|string',
        ];
    }
}

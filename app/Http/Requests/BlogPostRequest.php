<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'blog_post_title' => 'required',
            'blog_post_content' => 'required|',
            'blog_post_publish_date' => 'required|date',
            'post_type_id' => 'required',
            'blog_post_image[]' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}

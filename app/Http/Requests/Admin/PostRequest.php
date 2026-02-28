<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($this->route('post'), 'post_id'),
            ],
            'image' => [$this->method() === 'POST' ? 'required' : 'nullable', 'image'],
            'body' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'blog_categories' => ['nullable', 'array'],
            'blog_categories.*' => ['exists:blog_categories,category_id'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:99999',
        ];
    }
}

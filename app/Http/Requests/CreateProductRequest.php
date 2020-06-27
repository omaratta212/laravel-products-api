<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric',
            'details' => 'required',
            'main_image' => 'nullable|image|mimes:jpg,png,jpeg',
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'How come a product without name?!',
            'price.required' => "So, you'r selling this for free??",
            'price.numeric' => 'It must to be a number you know?',
            'details.required' => "People have to know what's that !",
        ];
    }
}

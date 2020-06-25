<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
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
            'name.required' => 'I\'m pencils, who are you?',
            'name.unique' => 'Hey, we already know you! login instead.',
            'email.required' => 'We need your email! please.',
            'email.email' => 'No no no, give me a real email!',
            'email.unique' => 'Hey, we already know you! login instead.',
            'password.required' => 'No password? really?!',
            'password.min' => 'Are you kidding me? create a real password!',
            'password_confirmation.required'  => 'We need to make sure you remember the password!',
            'password_confirmation.same'  => 'Passwords don\'t match, let\'s make another one.',
        ];
    }
}

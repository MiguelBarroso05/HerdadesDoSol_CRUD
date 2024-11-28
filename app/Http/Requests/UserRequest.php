<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('user'); // Captura o ID se for atualização (rota deve incluir {id})

        return [
            'username' => 'required|unique:users,username' . ($id ? ',' . $id : '') . '|min:3|max:50',
            'email' => 'required|email|unique:users,email' . ($id ? ',' . $id : ''),
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => $id ? 'nullable|min:8' : 'required|min:8', // Senha obrigatória na criação, opcional na atualização
            'img' => 'nullable|image|max:2048',
        ];
    }


    public function messages()
    {
        return [
            'username.required' => 'The username field is required.',
            'username.unique' => 'The username already exists.',
            'username.min' => 'The username must be at least 3 characters.',
            'username.max' => 'The username may not be greater than 50 characters.',

            'firstname.required' => 'The firstname field is required.',
            'lastname.required' => 'The lastname field is required.',

            'email.required' => 'The email field is required.',
            'email.unique' => 'The email already exists.',

            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',

            'img.image' => 'The image must be an image.',
        ];
    }
}

<?php

namespace App\Http\Requests\user;

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
        $id = $this->route('user');

        return [
            /*Campos comuns entre clientes e admins*/
            'address_id' => 'nullable|exists:addresses,id',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email' . ($id ? ',' . $id : ''),
            'nif' => 'nullable|unique:users,nif' . ($id ? ',' . $id : ''),
            'password' => $id ? 'nullable|min:8' : 'required|min:8',
            'birthdate' => 'nullable|date|before:18 years ago',
            'phone' => 'nullable|min:9|unique:users,phone' . ($id ? ',' . $id : ''),
            'role' => 'nullable|exists:roles,id',

            /*Campos únicos de staff*/
            'username' => 'nullable|unique:users,username' . ($id ? ',' . $id : '') . '|min:3|max:50',
            'img' => 'nullable|image|max:2048',

            /*Campos únicos de cliente*/
            'balance' => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            // Username validation messages
            'username.required' => 'The username field is required.',
            'username.unique' => 'The username already exists.',
            'username.min' => 'The username must be at least 3 characters.',
            'username.max' => 'The username may not be greater than 50 characters.',

            // Name validation messages
            'firstname.required' => 'The firstname field is required.',
            'lastname.required' => 'The lastname field is required.',

            // Email validation messages
            'email.required' => 'The email field is required.',
            'email.unique' => 'The email already exists.',

            // Password validation messages
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',

            // Image validation messages
            'img.image' => 'The image must be a valid image file.',
            'img.max' => 'The image size may not exceed 2MB.',

            //Birtdate validation messages
            'birthdate.date' => 'The birthdate must be a date.',
            'birthdate.before' => 'The birthdate must be before 18 years ago.',

            // Phone validation messages
            'phone.min' => 'The phone must be at least 9 characters.',
            'phone.unique' => 'The phone already exists.',

            // Balance validation messages
            'balance.numeric' => 'The balance must be a number.',
            'balance.min' => 'The balance must be at least 0.',

            // Nif validation messages
            'nif.unique' => 'The nif already exists.',
        ];
    }
}

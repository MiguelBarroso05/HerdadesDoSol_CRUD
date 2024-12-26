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
            'address_id' => 'nullable',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email' . ($id ? ',' . $id : ''),
            'nif' => 'nullable|unique:users,nif' . ($id ? ',' . $id : ''),
            'password' => $id ? 'nullable|min:8' : 'required|min:8',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|min:9',
            'role' => 'nullable|exists:roles,id',

            /*Campos únicos de staff*/
            'username' => 'nullable|unique:users,username' . ($id ? ',' . $id : '') . '|min:3|max:50',
            'img' => 'nullable|image|max:2048',

            /*Campos únicos de cliente*/
            'balance' => 'nullable',
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

            // Address validation messages
            'address.max' => 'The address may not be greater than 255 characters.',

            // City validation messages
            'city.max' => 'The city may not be greater than 255 characters.',

            // Country validation messages
            'country.max' => 'The country may not be greater than 255 characters.',

            // Postal code validation messages
            'postal.max' => 'The postal code may not be greater than 20 characters.',
        ];
    }
}

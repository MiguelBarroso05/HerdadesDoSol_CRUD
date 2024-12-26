<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
        return [
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
        ];
    }

    public function messages(): array{
        return [
            'address.required' => 'The address is required.',
            'country.required' => 'The country is required.',
            'city.required' => 'The city is required.',
            'zip_code.required' => 'The zip code is required.',
        ];
    }
}

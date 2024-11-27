<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationRequest extends FormRequest
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
            'size' => 'required|integer|min:1|max:6',
            'room_type_id' => 'required',
            'description' => 'nullable|max:255',
        ];
    }

    public function messages()
    {
        return [
            'size.required' => 'the size is required.',
            'size.integer' => 'the size must be an integer.',
            'size.min' => 'the size must be at least 1.',
            'size.max' => 'the size must be less than 6.',

            'room_type_id.required' => 'the room type is required.',

            'description.max' => 'The description may not be greater than 255 characters.',
        ];
    }
}

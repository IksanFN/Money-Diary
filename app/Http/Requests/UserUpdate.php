<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdate extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', Rule::unique('users', 'email')->ignore($this->user->id, 'id')],
            'nisn' => ['required', 'numeric', Rule::unique('users', 'nisn')->ignore($this->user->id, 'id')],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg'],
            'password' => ['required', 'min:6']
        ];
    }
}

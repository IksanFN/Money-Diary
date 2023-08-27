<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentUpdate extends FormRequest
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
            'user_id' => ['required', Rule::unique('students', 'user_id')->ignore($this->student->id, 'id')],
            'kelas_id' => ['required'],
            'major_id' => ['required'],
            'gender' => ['required', 'in:Male,Female'],
            'student_phone' => ['required', 'numeric', 'min:6'],
            'alamat' => ['nullable'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConductorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'staff_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('conductors')->whereNull('deleted_at')
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                Rule::unique('conductors')->whereNull('deleted_at')
            ],
            'phone_number' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9]{10,15}$/',
                Rule::unique('conductors')->whereNull('deleted_at')
            ],
            'department_name' => 'required|string|max:255',
        ];
    }
}

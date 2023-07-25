<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => [
                'required',
                'regex:/^(04|\+614)[0-9]{8}$/'
                // Contact numbers may be shared by workers
                // Rule::unique('workers', 'contact_number')
            ],
            // Email may be shared by workers
            //  'email' => 'required|email|unique:workers',
            'email' => 'required|email',
            'date_of_birth' => 'required',
            'driving_license' => 'nullable',
            'driving_license_expiry' => 'nullable',
            'hr_license' => 'nullable',
            'hr_license_expiry' => 'nullable',
            'white_card' => 'nullable',
            //'roles' => 'required',
            'emergency_contact_name' => 'required',
            'emergency_contact_number' => [
                'required',
                'regex:/^(04|\+614)[0-9]{8}$/'
                // Emergency contact numbers may be shared by workers
                // Rule::unique('workers', 'emergency_contact_number')
            ],
            'start_date' => 'nullable',
            'finish_date' => 'nullable',
            'employment_type' => 'required',
            'status' => 'required',
            'notes' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'contact_number.unique' => 'The :attribute field must be unique.',
            'contact_number.regex' => 'The :attribute field must start with 04 or +614 and be followed by 8 digits.',
            'emergency_contact_number.unique' => 'The :attribute field must be unique.',
            'emergency_contact_number.regex' => 'The :attribute field must start with 04 or +614 and be followed by 8 digits.',
        ];
    }
}

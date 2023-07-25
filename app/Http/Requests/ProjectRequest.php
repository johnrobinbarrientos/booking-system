<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'project_name' => 'required',
            'project_notes' => '',
            'project_order_number' => 'required|unique:projects,project_order_number,' . $this->project_id,
        ];
    }

    public function messages()
    {
        return [
            'project_contact_number.unique' => 'The :attribute field must be unique.',
            'project_contact_number.regex' => 'The :attribute field must start with 04 or +614 and be followed by 8 digits.',
            'postcode.*.regex' => 'The postcode must be a 4-digit number.',
        ];
    }
}

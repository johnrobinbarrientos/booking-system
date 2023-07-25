<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubbieRequest extends FormRequest
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
            'name' => 'required',
            'contact_number' => 'required|numeric|digits_between:10,11',
        ];
    }

    public function messages()
    {
        return [
        'contact_number.regex' => 'The :attribute field must start with 04 or +614 and be followed by 8 digits.',
        ];
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => 'required|min:6',
            'address' => 'nullable',
            'abn' => 'nullable',
            'client_number' => 'nullable',
            'client_notes' => '',
            'bad_credit' => 'boolean|nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Company name is required!',
            'address.required' => 'Address is required!',
            'abn.required' => 'ABN is required!',
            'client_number.required' => 'Client Number is required!',
        ];
    }
}

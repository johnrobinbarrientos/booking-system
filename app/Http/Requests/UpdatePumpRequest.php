<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePumpRequest extends FormRequest
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
            'pump_name' => 'required',
            'plant_number' => 'required',
            'registration' => 'required',
            'location' => '',
            'concrete_pumped_opening_balance' => 'nullable|numeric',
            'year' => '',
            'model' => '',
            'serial_no' => '',
            'worksafe_no' => '',
            'status' => '',
            'notes' => '',
            'pump_docket_number' => 'required|numeric'
        ];
    }
}

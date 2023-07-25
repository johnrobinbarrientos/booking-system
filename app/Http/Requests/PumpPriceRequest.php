<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PumpPriceRequest extends FormRequest
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
            'price_group_id'=> 'required',
            'pump_category_id'=> 'required',
            'size'=> '',
            'min_hire_first_2_hours_on_site'=> 'required',
            'extra_time_per_hour'=> 'required',
            'per_cube_meter_of_concrete'=> 'required',
        ];
    }
}

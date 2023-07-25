<?php

namespace App\Http\Requests;

use App\Helpers\Helper;
use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BookingRequest extends FormRequest
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
            'customer_order_number' => '',
            'booking_number' => '',
            'job_date' => '',
            'date_booked' => '',
            'booking_status' => '',
            'job_description' => '',
            'job_start_time' => '',
            'concrete_time' => '',
            'metres_to_pump' => '',
            'concrete_mix' => '',
            'job_notes' => '',
            'docket_no' => '',
            'pump_docket_number_origin' => '',
            'm3' => '',
            'time_onsite' => '',
            'time_offsite' => '',
            'total_hours' => '',
            'metres_pumped' => '',
            'cement_bag'  => '',
            'fuel_levy'  => '',
            'extra_man' => '',
            'labour_rate' => '',
            'total_labour' => '',
            'travel' => '',
            'washout_bag' => '',
            'cost_per_bag' => '',
            'pipeline_extension' => '',
            'gst' => '',
            'extra_time_per_hour_cost' => '',
            'per_cube_meter_of_concrete' => '',
            'grand_total' => '',
            'total_washout_bag' => '',
            'client_id' => 'required',
            'contact_id' => '',
            'pump_id' => '',
            'project_id' => 'required',
            'project_contact_id' => '',
            'price_group_id' => '',
            'pump_category_id' => '',
            'pump_price_id' => '',
            'user_id' => '',
            'subbie_id' => '',
            'is_subbie_required' => '',
            'project_address_id' => '',
            'concrete_supplier_id' => '',
            'concrete_type_id' => '',
            'min_hire' => '',
            'min_hire_rate' => '',
            'min_hire_total' => '',
            'metres_pumped_rate' => '',
            'metres_pumped_total' => '',
            'additional_man_per_hr' => '',
            'overtime_per_hr' => '',
            'overtime_per_hr_rate' => '',
            'overtime_per_hr_total' => '',
            'extra_time' => '',
            'extra_time_rate' => '',
            'extra_time_total' => '',
            'travel_rate' => '',
            'travel_total' => '',
            'washout_bag_rate' => '',
            'washout_bag_total' => '',
            'cement_bag_rate' => '',
            'cement_bag_total' => '',
            'offsite_clean_out' => '',
            'pipeline_extension_rate' => '',
            'pipeline_extension_total' => '',
            'sundries1_rate' => '',
            'sundries1_total' => '',
            'sundries2_rate' => '',
            'sundries2_total' => '',
            'ex_gst' => '',
            'additional_man_per_hr_rate' => '',
            'additional_man_per_hr_total' => '',
            'offsite_clean_out_rate' => '',
            'offsite_clean_out_total' => '',
            'worker_operator_id' => '',
            'worker_hoseman_id' => '',
            'worker_extraman1_id' => '',
            'worker_extraman2_id' => '',
            'worker_extraman3_id' => '',
            'booking_notes' => '',
            'actual_pump_sent' => '',
            'client_none_contact_name' => '',
            'client_none_contact_no' => '',
            'client_none_contact_email' => '',
            'client_none_contact_address' => '',
            'project_none_contact_name' => '',
            'project_none_contact_no' => '',
            'project_none_contact_email' => '',
            'project_none_contact_address' => '',
        ];
    }

    public function messages(){
        return [
            'client_id.required' => 'Client is required field',
            'project_id.required' => 'Project is required field',
        ];
    }
}

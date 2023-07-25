<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CSVFileRequest extends FormRequest
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
            'file' => 'required|mimes:csv,txt|max:10000'
        ];
    }

    public function messages(){
        return [
            'file.required' => 'Please choose a File',
            'file.mimes' => 'Please upload a CSV file',
        ];
    }
}

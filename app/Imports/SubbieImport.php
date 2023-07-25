<?php

namespace App\Imports;

use Throwable;
use App\Models\Subbie;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SubbieImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Subbie([
            'name' => !empty($row['name'])?$row['name']:'',
            'contact_number' => !empty($row['contact_number'])?$row['contact_number']:'',

        ]);
    }

    public function rules(): array
    {
        return [
            '*.contact_number' => ['required', Rule::unique('subbies', 'contact_number')],
        ];
    }

    public function messages(): array
    {
        return [
            '*.contact_number.required' => 'The contact number is required',
            '*.contact_number.unique' => 'The contact number has already been taken',
        ];
    }

    public function onError(Throwable $error)
    {
        //
    }
}

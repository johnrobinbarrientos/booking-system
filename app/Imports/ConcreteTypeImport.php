<?php

namespace App\Imports;

use Throwable;
use App\Models\ConcreteType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ConcreteTypeImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //dd($row);
        return new ConcreteType([
            'concrete_type' => $row['concrete'] . ' ' . $row['type'],
        ]);
    }

    public function rules(): array
    {
        return [
            'concrete_type' => [''],
        ];
    }

    public function messages(): array
    {
        return [
            'concrete_type.required' => 'The concrete type is required',
        ];
    }

    public function onError(Throwable $error)
    {
        //
    }
}

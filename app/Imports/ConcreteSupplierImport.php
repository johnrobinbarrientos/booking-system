<?php

namespace App\Imports;

use Throwable;
use App\Models\ConcreteSupplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ConcreteSupplierImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
   /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //dd($row);
        return new ConcreteSupplier([
            'concrete_supplier' => $row['concrete'] . ' ' . $row['supplier'],
        ]);
    }

    public function rules(): array
    {
        return [
            'concrete_supplier' => [''],
        ];
    }

    public function messages(): array
    {
        return [
            'concrete_supplier.required' => 'The concrete type is required',
        ];
    }

    public function onError(Throwable $error)
    {
        //
    }
}

<?php

namespace App\Imports;

use Throwable;
use App\Models\Pump;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PumpImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use Importable;

    public function model(array $row)
    {
        if (!is_null($row['concrete_pumped_opening_balance'])) {
            $concrete_pumped_opening_balance = intval($row['concrete_pumped_opening_balance']);
        } else {
            $concrete_pumped_opening_balance = null;
        }
        
        return Pump::create([
            'pump_name' => $row['pump_name'],
            'plant_number' => $row['plant_number'],
            'registration' => $row['registration'],
            'location' => $row['location'],
            'year' => intval($row['year']),
            'make' => $row['make'],
            'model' => $row['model'],
            'concrete_pumped_opening_balance' => $concrete_pumped_opening_balance,
            'serial_no' => $row['serial_no'],
            'worksafe_no' => $row['worksafe_no'],
            'status' => $row['status'],
            'notes' => $row['notes'],
        ]);
        /*$mappedData = [];

        foreach ($rows as $row) {
            if (!is_null($row[7])) {
                $concrete_pumped_opening_balance = intval($row[7]);
            } else {
                $concrete_pumped_opening_balance = null;
            }

            $mappedData[] = [
                'pump_name' => $row[0],
                'plant_number' => $row[1],
                'registration' => $row[2],
                'location' => $row[3],
                'year' => intval($row[4]),
                'make' => $row[5],
                'model' => $row[6],
                'concrete_pumped_opening_balance' => $concrete_pumped_opening_balance,
                'serial_no' => $row[8],
                'worksafe_no' => $row[9],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Pump::insert($mappedData);*/
    }

    public function rules(): array
    {
       return [
           '*.registration' => ['required', Rule::unique('pumps', 'registration')],
       ];
    }

    public function messages(): array
    {
       return [
           '*.registration.required' => 'Registration is required',
           '*.registration.unique' => 'Regsitartion must be unique',
       ];
    }

    public function onError(Throwable $error)
    {
        //
    }
}

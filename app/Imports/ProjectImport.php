<?php

namespace App\Imports;

use Throwable;
use App\Models\Project;
use App\Models\ProjectAddress;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProjectImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //saving Project First 
        $project = new Project([
            'project_name' => $row['project_name'],
            'project_notes' => $row['project_notes'],
            'project_order_number' => $row['project_order_number'],
            'project_contact_name' => $row['project_contact_name'],
            'project_contact_number' => $row['project_contact_number'],
        ]);

        $project->save();

        //saving contacts
        for ($i = 1; $i <= 2; $i++) {
            $address = $row['address_' . $i];
            $suburb = $row['suburb_' . $i];
            $state = $row['state_' . $i];
            $postcode = $row['postcode_' . $i];

            if (!empty($address) || !empty($suburb) || !empty($state)|| !empty($postcode)) {
                $projectAddresses = new ProjectAddress([
                    'address' => $address,
                    'suburb' => $suburb,
                    'state' => $state,
                    'postcode' => $postcode,
                ]);

                $projectAddresses->project_id = $project->id;
                $projectAddresses->save(); 
            }
        }

        return $project;
    }

    public function rules(): array
    {
        return [
            '*.project_contact_number' => ['required', Rule::unique('projects', 'project_contact_number')],
        ];
    }

    public function messages(): array
    {
        return [
            '*.project_contact_number.required' => 'The contact number is required',
            '*.project_contact_number.unique' => 'The contact number has already been taken',
        ];
    }

    public function onError(Throwable $error)
    {
        //
    }
}

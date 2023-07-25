<?php

namespace App\Imports;

use Throwable;
use App\Models\Worker;
use App\Models\WorkerRole;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class WorkerImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    public function model(array $row)
    {
        $worker = new Worker([
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'contact_number' => is_numeric($row['contact_number']) ? intval($row['contact_number']) : null,
                'email' => !empty($row['email'])?$row['email']:'',
                'date_of_birth' => !empty($row['date_of_birth'])?date("Y-m-d", strtotime($row['date_of_birth'])):'',
                'driving_license' => !empty($row['driving_license']) ? trim($row['driving_license']) : null,
                'driving_license_expiry' => !empty($row['driving_license_expiry'])?date("Y-m-d", strtotime($row['driving_license_expiry'])):null,
                'hr_license' => !empty($row['hr_license']) ? trim($row['hr_license']) : null,
                'hr_license_expiry' => !empty($row['hr_license_expiry'])?date("Y-m-d", strtotime($row['hr_license_expiry'])):null,
                'white_card' => !empty($row['white_card']) ? trim($row['white_card']) : null,
                //'roles' => !empty($row['roles'])?$row['roles']:'',
                'emergency_contact_name' => !empty($row['emergency_contact_name'])?$row['emergency_contact_name']:'',
                'emergency_contact_number' => is_numeric($row['emergency_contact_number']) ? intval($row['emergency_contact_number']) : null,
            ]);

            $worker->save();
            /*$roleNames = explode(',', $row['roles']);
            $roles = WorkerRole::whereIn('role_name', $roleNames)->get();
            $worker->workerRoles()->attach($roles);*/
            $roleNames = explode(',', $row['roles']);
            $roles = collect($roleNames)->map(function ($roleName) {
                return WorkerRole::firstOrCreate(['role_name' => $roleName]);
            });
            $worker->workerRoles()->attach($roles->pluck('id'));

            // return worker
            return $worker;

    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:workers'],
            'driving_license' => ['nullable', 'unique:workers'],
            'hr_license' => ['nullable', 'unique:workers'],
            'white_card' => ['nullable', 'unique:workers'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.unique' => 'Email has already been taken',
        ];
    }

    public function onError(Throwable $error)
    {
        //
    }
}

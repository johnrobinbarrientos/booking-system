<?php

namespace App\Exports;

use App\Models\Worker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WorkerExport implements FromCollection, WithHeadings
{
    
    protected $download_type;

    function __construct($download_type) {
        $this->download_type = $download_type;
    }

    public function headings(): array
    {
        return ["First Name","Last Name", "Contact Number","Email","Date of Birth","Driving License","Driving License Expiry","HR License","HR License Expiry","White Card","White Card Expiry","Roles","Projects Inducted","Emergency Contact Name", "Emergency Contact Number"];
    }
    
    public function collection()
    {
        if($this->download_type == 'demo'){
            /*return Worker::select('first_name','last_name', 'contact_number', 'email', 'date_of_birth','driving_license','driving_license_expiry',
            'hr_license','hr_license_expiry','white_card', 'roles', 'emergency_contact_name', 'emergency_contact_number')
            ->latest()
            ->offset(0)->limit(1)->get();*/
            $workers = Worker::with('project','workerRoles')->latest() ->offset(0)->limit(1)->get();;

            $data = [];
            foreach($workers as $worker) {
                $roles = $worker->workerRoles->pluck('role_name')->implode(',');
                //$projects = $worker->project->pluck('project_name')->implode(',');
                $data[] = [
                    'first_name' => $worker->first_name,
                    'last_name' => $worker->last_name,
                    'contact_number' => $worker->contact_number,
                    'email' => $worker->email,
                    'date_of_birth' => $worker->date_of_birth,
                    'driving_license' => $worker->driving_license,
                    'driving_license_expiry' => $worker->driving_license_expiry,
                    'hr_license' => $worker->hr_license,
                    'hr_license_expiry' => $worker->hr_license_expiry,
                    'white_card' => $worker->white_card,
                    'roles' => $roles,
                    //'projects_inducted' => $projects,
                    'emergency_contact_name' => $worker->emergency_contact_name,
                    'emergency_contact_number' => $worker->emergency_contact_number,
                ];
            }
        
            return collect($data);
        }else{
            /*return Worker::select('first_name','last_name', 'contact_number', 'email', 'date_of_birth','driving_license','driving_license_expiry',
            'hr_license','hr_license_expiry','white_card', 'roles', 'emergency_contact_name', 'emergency_contact_number')
            ->latest()
            ->get();*/

            $workers = Worker::with('project','workerRoles')->latest()->get();

    $data = [];
    foreach($workers as $worker) {
        $roles = $worker->workerRoles->pluck('role_name')->implode(',');
        $projects = $worker->project->pluck('project_name')->implode(',');
        $data[] = [
            'first_name' => $worker->first_name,
            'last_name' => $worker->last_name,
            'contact_number' => $worker->contact_number,
            'email' => $worker->email,
            'date_of_birth' => $worker->date_of_birth,
            'driving_license' => $worker->driving_license,
            'driving_license_expiry' => $worker->driving_license_expiry,
            'hr_license' => $worker->hr_license,
            'hr_license_expiry' => $worker->hr_license_expiry,
            'white_card' => $worker->white_card,
            'roles' => $roles,
            'projects_inducted' => $projects,
            'emergency_contact_name' => $worker->emergency_contact_name,
            'emergency_contact_number' => $worker->emergency_contact_number,
        ];
    }

    return collect($data);
        }
    }
}

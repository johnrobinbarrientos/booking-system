<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectExport implements FromCollection, WithHeadings
{
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->data == 'demo'){
            return Project::with('addresses')
            ->select("projects.*","project_name", "project_order_number", "project_notes", "project_contact_name", "project_contact_number")
            ->latest()->offset(0)->limit(1)
            ->get()
            ->map(function($project) {
                $addresses = $project->addresses->take(2);
                return [
                    'project_name' => $project->project_name,
                    'project_order_number' => $project->project_order_number,
                    'project_notes' => $project->project_notes,
                    'project_contact_name' => $project->project_contact_name,
                    'project_contact_number' => $project->project_contact_number,
                    'address_1' => $addresses->get(0)-> address ?? '',
                    'suburb_1' => $addresses->get(0)-> suburb ?? '',
                    'state_1' => $addresses->get(0)-> state ?? '',
                    'postcode_1' => $addresses->get(0)-> postcode ?? '',
                    'address_2' => $addresses->get(1)-> address ?? '',
                    'suburb_2' => $addresses->get(1)-> suburb ?? '',
                    'state_2' => $addresses->get(1)-> state ?? '',
                    'postcode_2' => $addresses->get(1)-> postcode ?? '',

                ];
            });
        }else{
            return Project::with('addresses')
            ->select("projects.*","project_name", "project_order_number", "project_notes", "project_contact_name", "project_contact_number")
            ->get()
            ->map(function($project) {
                $addresses = $project->addresses->take(2);
                return [
                    'project_name' => $project->project_name,
                    'project_order_number' => $project->project_order_number,
                    'project_notes' => $project->project_notes,
                    'project_contact_name' => $project->project_contact_name,
                    'project_contact_number' => $project->project_contact_number,
                    'address_1' => $addresses->get(0)-> address ?? '',
                    'suburb_1' => $addresses->get(0)-> suburb ?? '',
                    'state_1' => $addresses->get(0)-> state ?? '',
                    'postcode_1' => $addresses->get(0)-> postcode ?? '',
                    'address_2' => $addresses->get(1)-> address ?? '',
                    'suburb_2' => $addresses->get(1)-> suburb ?? '',
                    'state_2' => $addresses->get(1)-> state ?? '',
                    'postcode_2' => $addresses->get(1)-> postcode ?? '',
                ];
            });
        }
    }

    public function headings(): array
    {
        return ["Name","Order Number", "Notes", "Contact Name", "Contact Number", "Address 1","Suburb 1","State 1","Postcode 1","Address 2","Suburb 3","State 3","Postcode 3"];
    }
}

<?php

namespace App\Exports\Pumps;

use App\Models\Pump;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PumpExport implements FromCollection, WithHeadings
{
    protected $download_type;

    function __construct($download_type)
    {
        $this->download_type = $download_type;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->download_type == 'demo') {
            return Pump::select(
                "pump_name",
                "plant_number",
                "registration",
                "location",
                "year",
                "make",
                "model",
                "concrete_pumped_opening_balance",
                "serial_no",
                "worksafe_no",
                "status",
                "notes"
            )->orderBy('id', 'DESC')->offset(0)->limit(1)
                ->get();
        } else {
            return Pump::select(
                "pump_name",
                "plant_number",
                "registration",
                "location",
                "year",
                "make",
                "model",
                "concrete_pumped_opening_balance",
                "serial_no",
                "worksafe_no",
                "status",
                "notes"
            )
                ->get();
        }
    }

    public function headings(): array
    {
        return [
            "Pump Name", "Plant No", "Registration", "Location", "Year", "Make", "Model", "Concrete Pumped M2", "Serial No", "Worksafe No","Status","Notes"
        ];
    }
}

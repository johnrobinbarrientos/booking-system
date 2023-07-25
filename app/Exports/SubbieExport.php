<?php

namespace App\Exports;

use App\Models\Subbie;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubbieExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $download_type;

    function __construct($download_type) {
        $this->download_type = $download_type;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->download_type == 'demo'){
            return Subbie::select('id', 'name', 'contact_number')->latest()->offset(0)->limit(1)->get();
        }else{
            return Subbie::select('id', 'name', 'contact_number')->get();
        }
    }

    public function headings(): array
    {
        return ["ID", "Name", "Contact Number"];
    }
}

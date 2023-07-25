<?php

namespace App\Exports;

use App\Models\ConcreteType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConcreteTypeExport implements FromCollection, WithHeadings
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
            return ConcreteType::select('concrete_type',)->latest()->offset(0)->limit(1)->get();
        }else{
            return ConcreteType::select('concrete_type')->get();
        }
    }

    public function headings(): array
    {
        return ["Job Type"];
    }
}

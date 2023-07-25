<?php

namespace App\Exports;

use App\Models\ConcreteSupplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConcreteSupplierExport implements FromCollection, WithHeadings
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
            return ConcreteSupplier::select('concrete_supplier',)->latest()->offset(0)->limit(1)->get();
        }else{
            return ConcreteSupplier::select('concrete_supplier')->get();
        }
    }

    public function headings(): array
    {
        return ["Concrete Supplier"];
    }
}

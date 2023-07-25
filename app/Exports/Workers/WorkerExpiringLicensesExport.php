<?php

namespace App\Exports\Workers;

use App\Models\Worker;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class WorkerExpiringLicensesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $license_id;

    function __construct($license_id) {
            $this->license_id = $license_id;
    }

    public function collection()
    {

        $license_id = $this->license_id;
        $workers = [];
        
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(30);
        
        $drivingLicense = Worker::whereBetween('driving_license_expiry', [$startDate, $endDate])->get();
        $hrLicense = Worker::whereBetween('hr_license_expiry', [$startDate, $endDate])->get();


        $_counter=0;
        foreach ($drivingLicense as $key => $license) {
            $drivingLicense[$_counter]['type'] = 'Drivers License';
            $drivingLicense[$_counter]['license_expiry']= $license['driving_license_expiry'];
            $_counter++;
        }

        $_counter=0;
        foreach ($hrLicense as $key => $license) {
            $hrLicense[$_counter]['type'] = 'HR License';
            $hrLicense[$_counter]['license_expiry']= $license['hr_license_expiry'];
            $_counter++;
        }


        if ($license_id == 1) {
            $workers = $drivingLicense;
        }

        if ($license_id == 2) {
            $workers = $hrLicense;
        }


        if($license_id == 0){

            $_counter=0;
            foreach ($drivingLicense as $key => $license) {
                $workers[$_counter]['first_name']= $license['first_name'];
                $workers[$_counter]['last_name']= $license['last_name'];
                $workers[$_counter]['type'] = 'Drivers License';
                $workers[$_counter]['license_expiry']= $license['driving_license_expiry'];
                $_counter++;
            }
    
            foreach ($hrLicense as $key => $license) {
                $workers[$_counter]['first_name']= $license['first_name'];
                $workers[$_counter]['last_name']= $license['last_name'];
                $workers[$_counter]['type'] = 'HR License';
                $workers[$_counter]['license_expiry']= $license['hr_license_expiry'];
                $_counter++;
            }
    

            $workers= collect(json_decode(json_encode($workers), false));

        }

        return $workers->map(function ($worker) {
            return [
                'First Name' => $worker->first_name ?? '',
                'Last Name' => $worker->last_name ?? '',
                'Type' => $worker->type ?? '',
                'License Expiry' => $worker->license_expiry ?? '',
            ]; 
        });
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Type',
            'License Expiry',
        ];
    }
}

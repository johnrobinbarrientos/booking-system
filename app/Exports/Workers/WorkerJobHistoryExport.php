<?php

namespace App\Exports\Workers;

use App\Models\Worker;
use App\Models\Booking;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class WorkerJobHistoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $worker_id;

    function __construct($request) {
            $this->worker_id = $request->worker_id;
    }

    public function collection()
    {

        $worker_id = $this->worker_id;

        $bookings = Booking::leftJoin('concrete_types', 'concrete_types.id', '=', 'bookings.concrete_type_id')
        ->with('project.addresses')
        ->orWhere('worker_operator_id', '=', $worker_id)
        ->orWhere('worker_hoseman_id', '=', $worker_id)
        ->orWhere('worker_extraman1_id', '=', $worker_id)
        ->orWhere('worker_extraman2_id', '=', $worker_id)
        ->orWhere('worker_extraman3_id', '=', $worker_id)
        
        ->selectRaw('booking_number, client_id, job_date, concrete_types.concrete_type as concrete_type, booking_status, actual_pump_sent, metres_pumped');


        $bookings = $bookings->orderBy('job_date', 'DESC')->get();

        $x = 0;

        foreach ($bookings as $key => $booking) {

            if ($booking->project_id){
                foreach ($booking->project->addresses as $key => $address) {
                    $bookings[$x]['address'] = $address->address. ' ' .$address->suburb. ' ' .$address->state. ' ' .$address->postcode;
                }
            }else{
                $bookings[$x]['address'] = $booking->project_none_contact_address;
            }
            $x++;
        }
        

        return $bookings->map(function ($booking) {
            return [
                'Job Date' => $booking->job_date ?? '',
                'Booking Status' => $booking->booking_status ?? '',
                'Client' => $booking->client->name ?? 'NONE',
                'Job Address' => $booking->address ?? '',
                'Pump No.' => $booking->actual_pump_sent ?? '',
                'Job Type' => $booking->concrete_type ?? '',
                'M3 Concrete Pumped' => $booking->metres_pumped ?? '',
            ]; 
        });
    }

    public function headings(): array
    {
        return [
            'Job Date',
            'Booking Status',
            'Client',
            'Job Address',
            'Pump No.',
            'Job Type',
            'M3 Concrete Pumped',
        ];
    }
}

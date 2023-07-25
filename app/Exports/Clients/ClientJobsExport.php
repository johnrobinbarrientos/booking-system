<?php

namespace App\Exports\Clients;

use Carbon\Carbon;
use App\Models\Booking;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientJobsExport implements FromCollection, WithHeadings
{
    protected $client_id;

    function __construct($client_id) {
        $this->client_id = $client_id;
    }

    public function collection()
    {
        $bookings = Booking::leftJoin('pumps', 'pumps.id', '=', 'bookings.pump_id')
        ->leftJoin('concrete_types', 'concrete_types.id', '=', 'bookings.concrete_type_id')
        ->whereNotNull('pump_id')
        ->where('client_id', $this->client_id)
        ->selectRaw('job_date, metres_to_pump, project_none_contact_address, docket_no, concrete_types.concrete_type as concrete_type, actual_pump_sent, grand_total, pump_name, plant_number, registration')
        ->get();

        return $bookings->map(function ($booking) {
            return [
                'Date of Job' => $booking->job_date ?? '',
                'Job Address' => $booking->project_none_contact_address ?? '',
                'Job Type' => $booking->concrete_type ?? '',
                'M3 Concrete Pumped' => $booking->metres_to_pump ?? '',
                'Pumped No.' => $booking->pump_name . ' - ' . $booking->plant_number . ' - ' . $booking->registration,
                'Docket No.' => $booking->docket_no ?? '',
                'Total Invoice Amount' => $booking->grand_total ?? '',
            ]; 
        });
    }

    public function headings(): array
    {
        return [
            'Date of Job',
            'Job Address',
            'Job Type',
            'M3 Concrete Pumped',
            'Pumped No.',
            'Docket No.',
            'Total Invoice Amount',
        ];
    }
}

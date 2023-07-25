<?php

namespace App\Exports\Pumps;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

use DateTime;

class PumpDocketHistoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $client_id;
    protected $docket_no;
    protected $job_date;
    protected $pump_id;

    function __construct($client_id, $docket_no, $job_date, $pump_id) {
            $this->client_id = $client_id;
            $this->docket_no = $docket_no;
            $this->job_date = $job_date;
            $this->pump_id = $pump_id;
    }

    public function collection()
    {

        $bookings = Booking::leftJoin('pumps', 'pumps.id', '=', 'bookings.pump_id')
        ->leftJoin('concrete_types', 'concrete_types.id', '=', 'bookings.concrete_type_id')
        ->with('project.addresses')
        ->whereNotNull('pump_id')
        ->selectRaw('client_id, pump_id, job_date, docket_no, concrete_types.concrete_type as concrete_type, metres_pumped, pump_name, project_id, project_none_contact_address, grand_total');

        if ($this->job_date != 0) {
            $dateRange = explode( ' - ', $this->job_date);
            $from = date_format(new DateTime($dateRange[0]), 'Y-m-d');
            $to = date_format(new DateTime($dateRange[1]), 'Y-m-d');
            
            $bookings = $bookings->whereBetween('job_date', [$from, $to]);
        }

        if ($this->docket_no != 0) {
            $bookings = $bookings->where('docket_no','LIKE','%'.$this->docket_no.'%');
        }

        if ($this->client_id != 0) {
            $bookings = $bookings->where('client_id', '=', $this->client_id);
        }

        if ($this->pump_id != 0) {
            $bookings = $bookings->where('pump_id', '=', $this->pump_id);
        }

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
                'Pump Name' => $booking->pump->pump_name ?? '',
                'Date' => $booking->job_date ?? '',
                'Client' => $booking->client->name ?? '',
                'Job Address' => $booking->address ?? '',
                'Job Type' => $booking->concrete_type ?? '',
                'Docket Number' => $booking->docket_no ?? '',
                'Metres Pumped (M3)' => $booking->metres_pumped ?? '',
                'Total Invoice' => $booking->grand_total ?? '',
            ]; 
        });
    }

    public function headings(): array
    {
        return [
            'Pump Name',
            'Date',
            'Client',
            'Job Address',
            'Job Type',
            'Docket Number',
            'Metres Pumped (M3)',
            'Total Invoice',
        ];
    }
}

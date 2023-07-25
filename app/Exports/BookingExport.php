<?php

namespace App\Exports;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Worker;
use App\Models\Pump;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;


class BookingExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $duration;
    protected $request_date;
    protected $daterange;
    protected $client_id;
    protected $status;

    function __construct($request) {
            $this->duration = $request->duration;
            $this->request_date = $request->date;
            $this->daterange = $request->daterange;
            $this->client_id = $request->client_id;
            $this->status = $request->status;
    }

    public function collection()
    {
        $duration = $this->duration;

        $request_date = $this->request_date;

        $daterange = $this->daterange;

        $client_id = $this->client_id;

        $status = $this->status;

        $query = Booking::with('client', 'worker', 'pump', 'PumpCategory', 'PumpPrice', 'PriceGroup');

            if ($duration == 1) { //Today
                $date = date('Y-m-d');
                //$query->where('job_date', $date);
                $query->whereRaw('"' . $date . '" between `booking_from_date` and `booking_to_date`')
                    ->orWhereDate('job_date', $date);

            }
            if ($duration == 2) { //Tomorrow
                $date = date('Y-m-d', strtotime('+1 days'));
                $query->whereRaw('"' . $date . '" between `booking_from_date` and `booking_to_date`')
                    ->orWhereDate('job_date', $date);

            }
            if ($duration == 3) { //Next Week
                $days = getWeekDates('next-week');
                $start_date = $days[0]->format('Y-m-d');
                $end_date = $days[6]->format('Y-m-d');
                $query->where(function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('booking_from_date', [$start_date, $end_date])
                        ->orWhereBetween('booking_to_date', [$start_date, $end_date]);
                })
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->whereBetween('job_date', [$start_date, $end_date]);
                    });

            }
            if ($duration == 4) { //Next Month
                $days = getMonthDates('next-month');
                $start_date = $days['start_date'];
                $end_date = $days['end_date'];

                $query->where(function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('booking_from_date', [$start_date, $end_date])
                        ->orWhereBetween('booking_to_date', [$start_date, $end_date]);
                })
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->whereBetween('job_date', [$start_date, $end_date]);
                    });

            }
            if ($duration == 5) { //Last Week
                $days = getWeekDates('last-week');
                $start_date = $days[0]->format('Y-m-d');
                $end_date = $days[6]->format('Y-m-d');

                $query->where(function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('booking_from_date', [$start_date, $end_date])
                        ->orWhereBetween('booking_to_date', [$start_date, $end_date]);
                })
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->whereBetween('job_date', [$start_date, $end_date]);
                    });

            }
            if ($duration == 6) { //Last Month
                $days = getMonthDates('last-month');
                $start_date = $days['start_date'];
                $end_date = $days['end_date'];

                $query->where(function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('booking_from_date', [$start_date, $end_date])
                        ->orWhereBetween('booking_to_date', [$start_date, $end_date]);
                })
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->whereBetween('job_date', [$start_date, $end_date]);
                    });

            }
            if ($duration == 7) { //date range
                $date = $request_date;

                $query->whereRaw('"' . $date . '" between `booking_from_date` and `booking_to_date`')
                    ->orWhereDate('job_date', $date);
                $duration_message = "This booking are of " . date('d F Y', strtotime($date));
            }
            if ($duration == 8) { //Last Month
                $days = explode(' - ', $daterange);
                $start_date = $days[0];
                $end_date = $days[1];

                $query->where(function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('booking_from_date', [$start_date, $end_date])
                        ->orWhereBetween('booking_to_date', [$start_date, $end_date]);
                })
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->whereBetween('job_date', [$start_date, $end_date]);
                    });
            }

            if ($status) {
                if ($status == 1) {
                    $query->where('booking_status','=', 'Confirmed');
                }
                if ($status == 2) {
                    $query->where('booking_status','=', 'Allocated');
                }
                if ($status == 3) {
                    $query->where('booking_status','=', 'Shadow Booking');
                }
                if ($status == 4) {
                    $query->where('booking_status','=', 'Canceled');
                }
                if ($status == 5) {
                    $query->where('booking_status','=', 'Unallocated');
                }
                if ($status == 6) {
                    $query->where('booking_status','=', 'Complete');
                }
                if ($status == 7) {
                    $query->where('booking_status','=', 'Jobs To Check');
                }
            }

            if ($client_id) {
                if ($client_id == 'NONE') {
                    $query->where('client_id','=', null);
                }else{
                    $query->where('client_id','=', $client_id);
                }
            }

         $bookings = $query->get();

         $x = 0;

        foreach ($bookings as $key => $booking) {

            if ($booking->project_id){
                foreach ($booking->project->addresses as $key => $address) {
                    $bookings[$x]['project_address'] = $address->address. ' ' .$address->suburb. ' ' .$address->state. ' ' .$address->postcode;
                }
            }else{
                $bookings[$x]['project_address'] = $booking->project_none_contact_address;
            }

            if ($booking->client_id){
                $bookings[$x]['client_contact_name'] = optional($booking->client)->primaryContact()->contact_name ?? null;
                $bookings[$x]['client_contact_number'] = optional($booking->client)->primaryContact()->contact_phone ?? null;
                $bookings[$x]['client_contact_email'] = optional($booking->client)->primaryContact()->contact_email ?? null;
                $bookings[$x]['client_contact_address'] = $booking->client->address ?? '';
            }else{
                $bookings[$x]['client_contact_name'] = $booking->client_none_contact_name;
                $bookings[$x]['client_contact_number'] = $booking->client_none_contact_no;
                $bookings[$x]['client_contact_email'] = $booking->client_none_contact_email;
                $bookings[$x]['client_contact_address'] = $booking->client_none_contact_address;
            }

            $operator = Worker::where('id', $booking->worker_operator_id)->select('id','first_name','last_name')->first();
            $hoseman =  Worker::where('id', $booking->worker_hoseman_id)->select('id','first_name','last_name')->first();
            $extraman1 = Worker::where('id', $booking->worker_extraman1_id)->select('id','first_name','last_name')->first();
            $extraman2 = Worker::where('id', $booking->worker_extraman2_id)->select('id','first_name','last_name')->first();
            $extraman3 = Worker::where('id', $booking->worker_extraman3_id)->select('id','first_name','last_name')->first();

            $worker_assigned = '';

            if ($operator){
                $worker_assigned = $operator->first_name . ' ' . $operator->last_name;
            }
            if ($hoseman){
                $worker_assigned = $worker_assigned . ', ' . $hoseman->first_name . ' ' . $hoseman->last_name;
            }
            if ($extraman1){
                $worker_assigned = $worker_assigned . ', ' . $extraman1->first_name . ' ' . $extraman1->last_name;
            }
            if ($extraman2){
                $worker_assigned = $worker_assigned . ', ' . $extraman2->first_name . ' ' . $extraman2->last_name;
            }
            if ($extraman3){
                $worker_assigned = $worker_assigned . ', ' . $extraman3->first_name . ' ' . $extraman3->last_name;
            }

            $bookings[$x]['worker_assigned'] = $worker_assigned;

            $x++;
        }

        return $bookings->map(function ($booking) {
            return [
                'Booking ID' => $booking->booking_number ?? '',
                'Job date' => $booking->job_date ?? '',
                'Concrete Time' => Carbon::parse($booking->concrete_time)->format('h:i A') ?? '',
                'Booking Status' => $booking->booking_status ?? '',
                'Client Name' => $booking->client->name ?? 'NONE',

                'Client Contact Name' => $booking->client_contact_name,
                'Client Contact Number' => $booking->client_contact_number,
                'Client Contact Email' => $booking->client_contact_email,
                'Client Address' => $booking->client_contact_address,

                'Project Name' => $booking->project->project_name ?? 'NONE',
                'Project Address' => $booking->project_address,

                'Worker Assigned' => $booking->worker_assigned,
                'Pump Name' => $booking->pump ? $booking->pump->pump_name . ' ' . ($booking->pump->plant_number ?? '') : '',
                'Pump Size' => $booking->PumpPrice->size ?? '',
                'Pump Category' => $booking->PumpCategory->category_name ?? '',
                'Metres Pumped' => $booking->metres_pumped ?? ''
            ]; 
        });
    }

    public function headings(): array
    {
        return [
            'Booking ID',
            'Job Date',
            'Concrete Time',
            'Booking Status',
            'Client Name',
            'Client Contact Name',
            'Client Contact Number',
            'Client Contact Email',
            'Client Address',
            'Project Name',
            'Project Address',
            'Worker Assigned',
            'Pump Name',
            'Pump Size',
            'Pump Category',
            'Metres Pumped'
        ];
    }
}

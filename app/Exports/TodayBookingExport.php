<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Worker;
use App\Models\Client;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TodayBookingExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $bookings = Booking::with(['client', 'project', 'projectAddress', 'worker', 'pump', 'PumpCategory', 'PumpPrice'])
            ->whereBetween('job_date', [Carbon::today(), Carbon::today()->endOfDay()])
            ->orWhere(function ($query) {
                $query->whereDate('booking_from_date', '<=', Carbon::today())
                    ->whereDate('booking_to_date', '>=', Carbon::today());
                })->get();

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
        // return Booking::with(['client', 'project', 'projectAddress', 'worker', 'pump', 'PumpCategory', 'PumpPrice'])
        //     ->whereBetween('job_date', [Carbon::today(), Carbon::today()->endOfDay()])
        //     ->orWhere(function ($query) {
        //         $query->whereDate('booking_from_date', '<=', Carbon::today())
        //             ->whereDate('booking_to_date', '>=', Carbon::today());
        //     })->get()->map(function ($booking) {
        //         return [
        //             'Booking ID' => $booking->booking_number ?? '',
        //             'Job date' => $booking->job_date ?? '',
        //             'Concrete Time' => Carbon::parse($booking->concrete_time)->format('h:i A') ?? '',
        //             'Booking Status' => $booking->booking_status ?? '',
        //             'Client Name' => $booking->client->name ?? '',
        //             'Client Contact Name' => optional($booking->client)->primaryContact()->contact_name ?? null,
        //             'Client Contact Number' => optional($booking->client)->primaryContact()->contact_phone ?? null,
        //             'Client Contact Email' => optional($booking->client)->primaryContact()->contact_email ?? null,

        //             'Client Address' => $booking->client->address ?? '',
        //             'Project Name' => $booking->project->project_name ?? '',
        //             'Project Address' =>
        //             $booking->projectAddress ? $booking->projectAddress->address . ', ' .
        //                 ($booking->projectAddress->suburb ?? '') . ', ' .
        //                 ($booking->projectAddress->state ?? '') . ', ' .
        //                 ($booking->projectAddress->postcode ?? '') : '',
        //             'Worker Assigned' => $booking->worker->pluck('name')->implode(',') ?? '',
        //             'Pump Name' => $booking->pump ? $booking->pump->pump_name . ' ' . ($booking->pump->plant_number ?? '') : '',
        //             'Pump Size' => $booking->PumpPrice->size ?? '',
        //             'Pump Category' => $booking->PumpCategory->category_name ?? '',
        //             'Metres Pumped' => $booking->metres_pumped ?? ''
        //         ];
        //     });
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

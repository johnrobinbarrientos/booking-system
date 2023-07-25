<?php

namespace App\Exports\Pumps;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PumpFinancialHistoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pastSevenYears = now()->subYears(1)->format('Y-m-d');
       
        $bookings = Booking::with(['pump', 'PumpCategory', 'PumpPrice'])
        ->where('job_date', '>=', $pastSevenYears)
        ->selectRaw('pump_id, pump_category_id, pump_price_id, sum(grand_total) as grand_total, sum(ex_gst) as total_amount_without_gst, count(DISTINCT project_id) as projects')
        ->groupBy(['pump_id', 'pump_category_id', 'pump_price_id'])
        ->get();

        return $bookings->map(function ($booking) {
            return [
                'Pump Name' => $booking->pump->pump_name ?? '',
                'Plant Number' => $booking->pump->plant_number ?? '',
                'Pump Size' => $booking->PumpPrice->size ?? '',
                'Pump Category' => $booking->Pumpcategory->category_name ?? '',
                'Total Projects' => $booking->projects,
                'Total Including Tax' => $booking->grand_total ?? '$0.00',
                'Total Without Tax' => $booking->total_amount_without_gst ?? '$0.00',
                'Average Per Job Excluding Tax' => $booking->projects == 0 ? "$0.00" : "$".number_format($booking->total_amount_without_gst/$booking->projects, 2),
            ]; 
        });
    }

    public function headings(): array
    {
        return [
            'Pump Name',
            'Plant Number',
            'Pump Size',
            'Pump Category',
            'Total Projects',
            'Total Including Tax',
            'Total Without Tax',
            'Average Per Job Excluding Tax',
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Client;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Ramsey\Uuid\Type\Decimal;

class ClientFinancialHistoryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $pastSevenYears = now()->subYears(7)->format('Y-m-d');
        $clients = Client::with(['bookings' => function ($query) use ($pastSevenYears) {
            $query->where('job_date', '>=', $pastSevenYears)
                ->selectRaw('client_id, sum(grand_total) as grand_total, sum(ex_gst) as total_amount_without_gst, count(DISTINCT project_id) as projects')
                ->groupBy('client_id');
        }])->get();

        return $clients->map(function ($client) {
            if (!empty($client->bookings)) {
                $average = 0.00;
                if (($client->bookings[0]->projects ?? 0) && ($client->bookings[0]->projects ?? 0) > 0) {
                    $average = (float)$client->bookings[0]->total_amount_without_gst / (float)$client->bookings[0]->projects;
                }
                return [
                    'Client Name' => $client->name,
                    'Total projects' => $client->bookings[0]->projects ?? '0',
                    'Total Including Tax' => "$".number_format($client->bookings[0]->grand_total ?? '0.00', 2),
                    'Total Without Tax' => "$".number_format($client->bookings[0]->total_amount_without_gst ?? '0.00', 2),
                   'Average Per Job Excluding Tax' => "$". number_format($average, 2),

                ];
            }
        });
    }

    public function headings(): array
    {
        return [
            'Client Name',
            'Total Projects',
            'Total Including Tax',
            'Total Without Tax',
            'Average Per Job Excluding Tax',
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Booking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientFinancialHistoryExport;
use App\Exports\Clients\ClientJobsExport;

class ClientReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getClientFinancialHistory(Request $request)
    {
        $pastSevenYears = now()->subYears(1)->format('Y-m-d');
        if ($request->get('client_history_filter') == 'past_7_years') {
            $pastSevenYears = now()->subYears(7)->format('Y-m-d');
        }
        $clients = Client::with(['bookings' => function ($query) use ($pastSevenYears) {
            $query->where('job_date', '>=', $pastSevenYears)
                ->selectRaw('client_id, sum(grand_total) as grand_total, sum(ex_gst) as total_amount_without_gst, count(DISTINCT project_id) as projects')
                ->groupBy('client_id');
        }])->paginate(10);

        return view('reports.clients.financial', compact('clients', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function export()
    {
        return Excel::download(new ClientFinancialHistoryExport, 'client_financial_history.csv');
    }

    public function exportClientJobs($client_id)
    {
        $client = Client::findOrFail($client_id);
        return Excel::download(new ClientJobsExport($client_id), $client->name . '.csv');
    }
}

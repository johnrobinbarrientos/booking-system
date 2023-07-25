<?php

namespace App\Http\Controllers;

use App\Exports\Workers\WorkerExpiringLicensesExport;
use App\Exports\Workers\WorkerJobHistoryExport;
use App\Models\Worker;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Pump;
use App\Models\Client;


class WorkerReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function exportExpiringLicense(Request $request)
    {
        return Excel::download(new WorkerExpiringLicensesExport($request->license_id), 'Expiring Licenses.csv');
    }

    public function getExpiringLicenses(Request $request)
    {
        
        $license_id = $request->license_id;
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
    

            $workers= json_decode(json_encode($workers), false);

            $license_id = 0;

        }

        
        return view('reports.workers.expiring-licenses', [
        'license_id' => $license_id,
        'workers' => $workers]);
    }

    public function getworkerHistory(Request $request)
    {
        $worker_id = $request->worker_id;

        $bookings = Booking::leftJoin('concrete_types', 'concrete_types.id', '=', 'bookings.concrete_type_id')
        ->with('project.addresses')
        ->orWhere('worker_operator_id', '=', $worker_id)
        ->orWhere('worker_hoseman_id', '=', $worker_id)
        ->orWhere('worker_extraman1_id', '=', $worker_id)
        ->orWhere('worker_extraman2_id', '=', $worker_id)
        ->orWhere('worker_extraman3_id', '=', $worker_id)
        
        ->selectRaw('booking_number, client_id, job_date, concrete_types.concrete_type as concrete_type, booking_status, actual_pump_sent, metres_pumped');


        $bookings = $bookings->orderBy('job_date', 'DESC')->paginate(10);
        

        $workers = Worker::all();

        return view('workers.history', [
        'bookings' => $bookings,
        'workers' => $workers,
        'worker_id' => $worker_id]);
    }

    public function exportWorkerJobHistory(Request $request)
    {
        $worker = Worker::findOrFail($request->worker_id);

        return Excel::download(new WorkerJobHistoryExport($request), $worker->first_name . ' ' . $worker->last_name .'.csv');
    }
}

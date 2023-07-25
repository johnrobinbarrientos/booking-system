<?php

namespace App\Http\Controllers;

use App\Exports\TodayBookingExport;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pump;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardOverview(Request $request)
    {
        //return view('pages/dashboard');
        if (!empty(auth::user()->two_factor_confirmed) && auth::user()->two_factor_confirmed == 1 || empty(auth::user()->two_factor_secret)) {
            //todays bookings
            $date = Date('Y-m-d');
            if ($request->date) {
                $date = $request->date;
            }

            $isWeekEnd = isWeekend($date);
            // echo $isWeekEnd;exit;

            //Unallocated Bookings
            $query = Booking::where('booking_status', '=', 'Unallocated');
            $query->where(function ($subquery) use ($date, $isWeekEnd) {
                $subquery->whereRaw('"' . $date . '" between `booking_from_date` and `booking_to_date`');
                if ($isWeekEnd == 1) {
                    $subquery->where('is_include_weekend', 1);
                }
                $subquery->orWhereDate('job_date', $date);
            });
            $unAllocatedBookings = $query->count();

            //Confirmed bookings for today 
            $query = Booking::where('booking_status', 'confirmed');
            $query->where(function ($subquery) use ($date, $isWeekEnd) {
                $subquery->whereRaw('"' . $date . '" between `booking_from_date` and `booking_to_date`');
                if ($isWeekEnd == 1) {
                    $subquery->where('is_include_weekend', 1);
                }
                $subquery->orWhereDate('job_date', $date);
            });
            // \DB::enableQueryLog();
            $confirmedBookingsForToday = $query->count();
            // print_r(\DB::getQueryLog());exit;

            //total bookings this week
            $monday = Carbon::now()->startOfWeek(Carbon::MONDAY)->startOfDay();
            $sunday = Carbon::now()->endOfWeek(Carbon::SUNDAY)->endOfDay();
            $totalBookingsThisWeek = Booking::whereBetween('job_date', [$monday, $sunday])
                ->orwhereRaw('"' . $date . '" between `booking_from_date` and `booking_to_date`')
                ->count();

            //todays bookings
            $query = Booking::with('client', 'concreteType' ,'project.addresses', 'worker', 'pump', 'PriceGroup', 'PumpPrice', 'PumpCategory')
                ->whereRaw('"' . $date . '" between `booking_from_date` and `booking_to_date`');
            if ($isWeekEnd == 1) {
                $query->where('is_include_weekend', 1);
            }
            $query->orWhereDate('job_date', $date);

            // \DB::enableQueryLog();
            $bookingsForToday = $query->latest()->paginate(10);
            // print_r(\DB::getQueryLog());exit;

            $x=0;

            foreach ($bookingsForToday as $key => $booking) {
                $operator = Worker::where('id', $booking->worker_operator_id)->select('id','first_name','last_name')->first();
                $hoseman =  Worker::where('id', $booking->worker_hoseman_id)->select('id','first_name','last_name')->first();
                $extraman1 = Worker::where('id', $booking->worker_extraman1_id)->select('id','first_name','last_name')->first();
                $extraman2 = Worker::where('id', $booking->worker_extraman2_id)->select('id','first_name','last_name')->first();
                $extraman3 = Worker::where('id', $booking->worker_extraman3_id)->select('id','first_name','last_name')->first();
                
                $bookingsForToday[$x]['workerOperator'] = $operator;
                $bookingsForToday[$x]['workerHoseman'] = $hoseman;
                $bookingsForToday[$x]['workerExtraman1'] = $extraman1;
                $bookingsForToday[$x]['workerExtraman2'] = $extraman2;
                $bookingsForToday[$x]['workerExtraman3'] = $extraman3;
                $x++;
            }


            $pumps = Pump::all();

            return view('pages.dashboard', compact('pumps', 'unAllocatedBookings', 'confirmedBookingsForToday', 'totalBookingsThisWeek', 'bookingsForToday'));
        } else {
            // echo "else";exit;
            // return redirect()->route('two-factor.login'); 
            return view('auth.two-factor-challenge');
        }
    }

    public function fetchBookings(Request $request)
    {
        $date = $request->date;
        $bookings = Booking::with('client', 'worker', 'pump')->whereDate('job_date', $date)->get();
        return response()->json($bookings);
        //return view('pages.dashboard', ['bookings' => $bookings, 'status_colors' => App\Models\Booking::STATUS_COLOR]);

    }

    //export todays booking
    public function todayBookingExport()
    {
        return Excel::download(new TodayBookingExport, 'bookings.xlsx');
    }


    public function profile()
    {
        return view('pages.account')->with('user', Auth::user());
    }


    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        return view('login.main');
    }
}

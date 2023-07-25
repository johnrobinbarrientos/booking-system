<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Carbon\Carbon;
use App\Models\Pump;
use App\Models\Client;
use App\Models\Subbie;
use App\Models\Worker;
use App\Helpers\Helper;
use App\Models\Booking;
use App\Models\Project;
use App\Models\Activity;
use App\Models\PriceGroup;
use App\Models\PumpCategory;
use Illuminate\Http\Request;
use App\Models\SumCubicMetre;
use App\Exports\BookingExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\BookingRequest;
use App\Models\ConcreteSupplier;
use App\Models\ConcreteType;
use App\Models\BookingSundries;
use App\Models\ClientProject;


class BookingController extends Controller
{

    public function index(Request $request)
    {
        $duration_message = '';
        $duration = $request->booking_filter;
        $status = $request->booking_status;
        $date = $request->date;
        $daterange = $request->daterange;

        $client_id = $request->client_id;

        $query = Booking::with('client', 'pump', 'PumpCategory', 'PumpPrice', 'PriceGroup');
        if ($request->booking_filter) {
            $duration = $request->booking_filter;
            if ($duration == 1) { //Today
                $date = date('Y-m-d');
                //$query->where('job_date', $date);
                $query->whereRaw('"' . $date . '" between `booking_from_date` and `booking_to_date`')
                    ->orWhereDate('job_date', $date);

                $duration_message = "This booking are of " . date('d F Y', strtotime($date));
            }
            if ($duration == 2) { //Tomorrow
                $date = date('Y-m-d', strtotime('+1 days'));
                $query->whereRaw('"' . $date . '" between `booking_from_date` and `booking_to_date`')
                    ->orWhereDate('job_date', $date);
                $duration_message = "This booking are of " . date('d F Y', strtotime($date));
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

                //$query->where('job_date', '>=', $start_date);
                //$query->where('job_date', '<=', $end_date);

                $duration_message = "These bookings are from " . date('d F Y', strtotime($start_date)) . " to " . date('d F Y', strtotime($end_date));
            }
            if ($duration == 4) { //Next Month
                $days = getMonthDates('next-month');
                $start_date = $days['start_date'];
                $end_date = $days['end_date'];

                //$query->where('job_date', '>=', $start_date);
                // $query->where('job_date', '<=', $end_date);
                $query->where(function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('booking_from_date', [$start_date, $end_date])
                        ->orWhereBetween('booking_to_date', [$start_date, $end_date]);
                })
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->whereBetween('job_date', [$start_date, $end_date]);
                    });

                $duration_message = "These bookings are from " . date('d F Y', strtotime($start_date)) . " to " . date('d F Y', strtotime($end_date));
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
                //dd($query);
                //$query->where('job_date', '>=', $start_date);
                //$query->where('job_date', '<=', $end_date);
                $duration_message = "These bookings are from " . date('d F Y', strtotime($start_date)) . " to " . date('d F Y', strtotime($end_date));
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


                //$query->where('job_date', '>=', $start_date);
                //$query->where('job_date', '<=', $end_date);
                $duration_message = "These bookings are from " . date('d F Y', strtotime($start_date)) . " to " . date('d F Y', strtotime($end_date));
            }
            if ($duration == 7) { //date range
                $date = $request->date;

                $query->whereRaw('"' . $date . '" between `booking_from_date` and `booking_to_date`')
                    ->orWhereDate('job_date', $date);
                $duration_message = "This booking are of " . date('d F Y', strtotime($date));
            }
            if ($duration == 8) { //Last Month
                $days = explode(' - ', $request->daterange);
                $start_date = $days[0];
                $end_date = $days[1];

                $query->where(function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('booking_from_date', [$start_date, $end_date])
                        ->orWhereBetween('booking_to_date', [$start_date, $end_date]);
                })
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->whereBetween('job_date', [$start_date, $end_date]);
                    });

                $duration_message = "These bookings are from " . date('d F Y', strtotime($start_date)) . " to " . date('d F Y', strtotime($end_date));
            }
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

        $bookings = $query->sortable()->latest()->paginate(10);

        $x=0;

        foreach ($bookings as $key => $booking) {
            $operator = Worker::where('id', $booking->worker_operator_id)->select('id','first_name','last_name')->first();
            $hoseman =  Worker::where('id', $booking->worker_hoseman_id)->select('id','first_name','last_name')->first();
            $extraman1 = Worker::where('id', $booking->worker_extraman1_id)->select('id','first_name','last_name')->first();
            $extraman2 = Worker::where('id', $booking->worker_extraman2_id)->select('id','first_name','last_name')->first();
            $extraman3 = Worker::where('id', $booking->worker_extraman3_id)->select('id','first_name','last_name')->first();
            
            $bookings[$x]['workerOperator'] = $operator;
            $bookings[$x]['workerHoseman'] = $hoseman;
            $bookings[$x]['workerExtraman1'] = $extraman1;
            $bookings[$x]['workerExtraman2'] = $extraman2;
            $bookings[$x]['workerExtraman3'] = $extraman3;
            $x++;
        }

        $clients = Client::select('id', 'name')->orderBy('name', 'ASC')->get();

        // return view('bookings.index', compact('bookings', 'duration_message', 'duration', 'daterange'));
        return view('bookings.index', [
            'bookings' => $bookings, 
            'duration_message' => $duration_message, 
            'duration' => $duration,
            'daterange' => $daterange,
            'client_id' => $client_id,
            'booking_status' => $status,
            'clients' => $clients]);
    }

    //update booking status
    public function updateBookingStatus(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->booking_status = $request->booking_status;
        $booking->save();
        return response()->json(['message' => 'Booking status updated successfully']);
        //return redirect()->route('booking.show', $booking->id)->with('success', 'Booking status updated successfully');
    }

    //update booking date range
    public function updateBookingDate(Request $request)
    {
        $booking = Booking::findOrFail($request->booking_id);
        $booking->booking_from_date = $request->booking_from_date;
        $booking->booking_to_date = $request->booking_to_date;
        $booking->is_include_weekend = !empty($request->is_include_weekend) ? 1 : 0;
        $booking->save();

        return response()->json(['message' => 'Booking date updated successfully']);
    }

    //duplicate booking
    public function duplicateBooking(Request $request)
    {
        $bookingFrom = new DateTime($request->booking_from_date);
        $bookingTo = new DateTime($request->booking_to_date);

        $abs_diff = $bookingFrom->diff($bookingTo)->format("%a");

        $dateStart = $request->booking_from_date;

        for ($x = 0; $x <= $abs_diff; $x++) {
            
            if (!empty($request->is_include_weekend)){ 

                $booking = Booking::find($request->booking_id);
                $duplicate = $booking->duplicate();

                if (!empty($booking->project_id)){
    
                    $result = Booking::where('project_id','=', $booking->project_id)->orderBy('id', 'desc')->first();

                    $split_sequence = substr($result->booking_number, strpos($result->booking_number, "-") + 1);
            
                    $project = Project::find($booking->project_id);
            
                    $booking_number = (string) $project->project_order_number . "-" . sprintf("%05s", (int) $split_sequence + 1);
                    $duplicate->booking_number = $booking_number;
                    $duplicate->job_date = $dateStart;
                    $duplicate->booking_status ='Unallocated';
                    $duplicate->save();

                }else{

                    $result = Booking::where('project_id','=', null)->orderBy('id', 'desc')->first();

                    $split_sequence = substr($result->booking_number, strpos($result->booking_number, "-") + 1);

            
                    $booking_number =  "0000" . "-" . sprintf("%05s", (int) $split_sequence + 1);
                    $duplicate->booking_number = $booking_number;
                    $duplicate->job_date = $dateStart;
                    $duplicate->booking_status ='Unallocated';
                    $duplicate->save();
                }


            }else{
                
                $dayOfWeek = date('w', strtotime($dateStart));

                if ($dayOfWeek == 0 || $dayOfWeek == 6) {
                } else {

                    $booking = Booking::find($request->booking_id);
                    $duplicate = $booking->duplicate();
            
                    if (!empty($booking->project_id)){

                        $result = Booking::where('project_id','=', $booking->project_id)->orderBy('id', 'desc')->first();

                        $split_sequence = substr($result->booking_number, strpos($result->booking_number, "-") + 1);
                
                        $project = Project::find($booking->project_id);
                
                        $booking_number = (string) $project->project_order_number . "-" . sprintf("%05s", (int) $split_sequence + 1);
                        $duplicate->booking_number = $booking_number;
                        $duplicate->job_date = $dateStart;
                        $duplicate->booking_status ='Unallocated';
                        $duplicate->save();

                    }else{
                        $result = Booking::where('project_id','=', null)->orderBy('id', 'desc')->first();

                        $split_sequence = substr($result->booking_number, strpos($result->booking_number, "-") + 1);
                
                        $booking_number = "0000" . "-" . sprintf("%05s", (int) $split_sequence + 1);
                        $duplicate->booking_number = $booking_number;
                        $duplicate->job_date = $dateStart;
                        $duplicate->booking_status ='Unallocated';
                        $duplicate->save();
                    }

                }
            }

            $dateStart = date("Y-m-d", strtotime("+1 day", strtotime($dateStart)));
        }


        return response()->json(['message' => 'Successfully Duplicated']);
    }

    public function updatePump(Request $request, $bookingId)
    {
        $booking = Booking::find($bookingId);
        $booking->pump_id = $request->pump_id;
        $booking->save();

        return response()->json(['message' => 'Pump updated successfully.']);
    }


    public function hist(Booking $booking)
    {
        $activities = $booking->activities()->orderBy('id', 'desc')->get();

        return view('bookings.hist', compact('activities'));
    }


    public function create()
    {
        $clients = Client::select('id', 'name')->orderBy('name', 'ASC')->get();

        $workerOperators = Worker::whereHas('workerRoles', function ($query) {
            $query->where('role_name', 'Operator')->where('status', 'Active')->orderBy('role_name', 'ASC');
        })->get();

        $workerHoseman = Worker::whereHas('workerRoles', function ($query) {
            $query->where('role_name', 'Hoseman')->where('status', 'Active')->orderBy('role_name', 'ASC');
        })->get();

        $workerExtramen = Worker::whereHas('workerRoles', function ($query) {
            $query->where('role_name', 'Extraman')->where('status', 'Active')->orderBy('role_name', 'ASC');
        })->get();


        $projects = Project::with('addresses')->with('contacts')->select('id', 'project_name', 'project_notes', 'project_order_number')->orderBy('project_name', 'ASC')->get();
        $pumps = Pump::select('id', 'pump_name', 'plant_number', 'registration', 'model', 'pump_docket_number')->where('status', 'Active')->orderBy('pump_name', 'ASC')->get();
        $subbies = Subbie::select('id', 'name')->orderBy('name', 'ASC')->get();
        $priceGroups = PriceGroup::all();
        $pumpCategories = PumpCategory::all();
        $concreteSuppliers = ConcreteSupplier::select('id','concrete_supplier')->orderBy('concrete_supplier', 'ASC')->get();
        $concreteTypes = ConcreteType::select('id','concrete_type')->orderBy('concrete_type', 'ASC')->get();

        return view('bookings.create', [
            'clients' => $clients,
            'operators' => $workerOperators,
            'hosemens' => $workerHoseman,
            'extramen' => $workerExtramen,
            'projects' => $projects,
            'pumps' => $pumps,
            'subbies' => $subbies,
            'priceGroups' => $priceGroups,
            'pumpCategories' => $pumpCategories,
            'concreteSuppliers' => $concreteSuppliers,
            'concreteTypes' => $concreteTypes,
        ]);
    }

    public function store(BookingRequest $request)
    {
        $validated = $request->validated();

        if($validated['project_id'] == 0){
            $validated['project_id'] = null;
        }

        if($validated['client_id'] == 0){
            $validated['client_id'] = null;
        }

        $job_start_time = $validated['job_start_time'];
        $start_time = DateTime::createFromFormat('H:i', $job_start_time);
        $concrete_time = $start_time->modify('+30 minutes');
        $concrete_time = $concrete_time->format('H:i');
        $validated['concrete_time'] = $concrete_time;


        //insert new booking
        $booking = Booking::create($validated + [
            'user_id' => Auth::id(),
        ]);

        $allSundries = Json_decode($request->allSundries);
        
        if(isset($allSundries)){
            foreach ($allSundries as $key => $sundries) {
                $bookingSundries = new BookingSundries();
                $bookingSundries->booking_id = $booking->id;
                $bookingSundries->sundries = $sundries->sundries;
                $bookingSundries->sundries_qty = $sundries->sundries_qty;
                $bookingSundries->sundries_rate = $sundries->sundries_rate;
                $bookingSundries->sundries_total = $sundries->sundries_total;
                $bookingSundries->save();
            }
        }

        $pump = Pump::find($booking->pump_id);
        if($pump){
            $pump->concrete_pumped_opening_balance = $booking->metres_pumped;
            $pump->save();
        }

        $pumpId = $request->input('pump_id');
        //saving the sum number of total cubic meter pumnped 
        $saveCubicMetre  = $request->input('metres_pumped');

        $sumCubicMetre = SumCubicMetre::firstOrNew(['pump_id' => $pumpId]);
        $sumCubicMetre->total_metres_pumped = $saveCubicMetre;

        //adding the booking id in sum cubic metres table 
        $sumCubicMetre->booking_id = $booking->id;
        $sumCubicMetre->save();

        // return redirect()->route('bookings.index')->with('success', 'Booking Added Successfully');
        return redirect()->route('dashboard')->with('success', 'Booking Added Successfully');
    }


    public function edit($id)
    {
        $clients = Client::with('contacts')->select('id', 'name','bad_credit')->orderBy('name', 'ASC')->get();

        $workerOperators = Worker::whereHas('workerRoles', function ($query) {
            $query->where('role_name', 'Operator')->where('status', 'Active')->orderBy('role_name', 'ASC');
        })->get();

        $workerHoseman = Worker::whereHas('workerRoles', function ($query) {
            $query->where('role_name', 'Hoseman')->where('status', 'Active')->orderBy('role_name', 'ASC');
        })->get();

        $workerExtramen = Worker::whereHas('workerRoles', function ($query) {
            $query->where('role_name', 'Extraman')->where('status', 'Active')->orderBy('role_name', 'ASC');
        })->get();
        
        // $projects = Project::with('addresses')->with('contacts')->select('id', 'project_name', 'project_notes', 'project_order_number')->orderBy('project_name', 'ASC')->get();

        $pumps = Pump::select('id', 'pump_name', 'plant_number', 'registration', 'model', 'pump_docket_number')->where('status', 'Active')->orderBy('pump_name', 'ASC')->get();
        $subbies = Subbie::select('id', 'name')->orderBy('name', 'ASC')->get();
        $booking = Booking::with('sundries')->find($id);

        $projects = ClientProject::leftJoin('projects', 'projects.id', '=', 'client_project.project_id')
        ->where('client_id', $booking->client_id)
        ->selectRaw('project_id as id, project_name, project_notes, project_order_number')
        ->get();

        $x = 0;

        if($projects){
            foreach ($projects as $key => $project) {
                $proj = Project::with('addresses')->with('contacts')->where('id', $project->id)->first();
                $projects[$x]['addresses'] = $proj->addresses;
                $projects[$x]['contacts'] = $proj->contacts;
                $x++;
            }
        }

        $priceGroups = PriceGroup::all();
        $pumpCategories = PumpCategory::all();
        $concreteSuppliers = ConcreteSupplier::select('id','concrete_supplier')->orderBy('concrete_supplier', 'ASC')->get();
        $concreteTypes = ConcreteType::select('id','concrete_type')->orderBy('concrete_type', 'ASC')->get();

        $url = url()->previous();
        $prev_route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        return view('bookings.edit', [
            'clients' => $clients,
            'operators' => $workerOperators,
            'hosemens' => $workerHoseman,
            'extramen' => $workerExtramen,
            'projects' => $projects,
            'pumps' => $pumps,
            'subbies' => $subbies,
            'priceGroups' => $priceGroups,
            'pumpCategories' => $pumpCategories,
            'booking' => $booking,
            'concreteSuppliers' => $concreteSuppliers,
            'concreteTypes' => $concreteTypes,
            'prev_route' => $prev_route,
        ]);
    }


    public function update(BookingRequest $request, Booking $booking)
    {
        $user = Auth::user();
        $input = $request->all();

        // Check if the job_start_time has changed
        if ($request->input('job_start_time') != $booking->job_start_time) {
            $job_start_time = $request->input('job_start_time');
            $start_time = Carbon::createFromFormat('H:i', $job_start_time);
            $concrete_time = $start_time->modify('+30 minutes');
            $concrete_time = $concrete_time->format('H:i');
            $input['concrete_time'] = $concrete_time;
        }

        if($request->input('project_id') == 0){
            $input['project_id'] = null;
        }

        if($request->input('client_id') == 0){
            $input['client_id'] = null;
        }


        $booking->update($input);

        //Sundries
        $allSundries = Json_decode($request->allSundries);

        $sundries_ids = [];

        if(isset($allSundries)){
            foreach ($allSundries as $key => $sundries) {
                if (is_null($sundries->id)) {
                    continue;
                }
                $sundries_ids[] = $sundries->id;
            }
        }

        BookingSundries::where('booking_id','=',$booking->id)->whereNotIn('id',$sundries_ids)->delete();

        foreach ($allSundries as $key => $sundries) {

            $bookingSundries = BookingSundries::where('booking_id','=',$booking->id)->where('id','=',$sundries->id)->first();
            $bookingSundries = (!$bookingSundries) ? new BookingSundries : $bookingSundries;
            $bookingSundries->booking_id = $booking->id;
            $bookingSundries->sundries = $sundries->sundries;
            $bookingSundries->sundries_qty = $sundries->sundries_qty;
            $bookingSundries->sundries_rate = $sundries->sundries_rate;
            $bookingSundries->sundries_total = $sundries->sundries_total;
            $bookingSundries->save();
        }

        //new booking workers sync code block 
        if (!empty($request->input('worker_id'))) {
            $booking->worker()->sync($request->input('worker_id'));
        } else {
            $booking->worker()->detach();
        }

        $pumpId = $request->input('pump_id');
        $saveCubicMetre = $request->input('metres_pumped');
        $bookingId = $booking->id;
        $sumCubicMetre = SumCubicMetre::firstOrNew(['pump_id' => $pumpId, 'booking_id' => $bookingId]);
        $sumCubicMetre->total_metres_pumped =  $saveCubicMetre;
        //adding the booking id in sum cubic metres table 
        $sumCubicMetre->booking_id = $booking->id;
        $sumCubicMetre->save();

        // Redirect to the index page with a success message
        // return redirect()->route('bookings.index')->with('success', 'Booking Updated Successfully');
        

        $prev_route = $request->input('prev_route');

        return redirect()->route($prev_route)->with('success', 'Booking Updated Successfully');
    }

    public function getDetails($id = 0)
    {
        $data = Client::with('contacts')->find($id);
        return response()->json($data);
    }

    public function getProjectLatestOrderNumber(Request $request)
    {

        $data = Booking::where('project_id','=', $request->project_id)->orderBy('id', 'desc')->first();
        
        if(isset($data->booking_number)){
            $result = substr($data->booking_number, strpos($data->booking_number, "-") + 1);
            $data->booking_number = sprintf("%05s", $result + 1);
        }else{
            $data = (object) 'booking_number';
            $data->booking_number = sprintf("%05s", 1);
        }

        return response()->json(['success' => 1, 'data' => $data], 200);
    }

    public function getPumpLatestOrderNumber($id = 0)
    {
        $pump = Pump::findOrFail($id);

        $result = Booking::where('pump_id','=', $id)->orderBy('id', 'desc')->first();

        $data = (object) 'docket_no';

        if(isset($result->booking_number)){

            if($result->pump_docket_number_origin == $pump->pump_docket_number){

                $data->docket_no = $result->docket_no + 1;

            }else{
                
                $data->docket_no = $pump->pump_docket_number;
            }
        }else{
            $data->docket_no = $pump->pump_docket_number;
        }

        return response()->json(['success' => 1, 'data' => $data, 'pump' => $pump], 200);
    }

    public function export(Request $request)
    {
        return Excel::download(new BookingExport($request), 'bookings.csv');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Worker;
use App\Models\Project;
use App\Models\WorkerRole;
use Illuminate\Http\Request;
use App\Exports\WorkerExport;
use App\Imports\WorkerImport;
use App\Http\Requests\WorkerRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CSVFileRequest;
use App\Http\Requests\UpdateWorkerRequest;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$workers = Worker::with('project')->get();
        $workers = Worker::where([
            ['first_name', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('first_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('contact_number', 'LIKE', '%' . $search . '%');
                }
            }]
        ])
            ->with('project', 'workerRoles')
            ->orderBy('last_name', 'asc')
            ->paginate(10);

        return view('workers.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        $workerRoles = WorkerRole::all();
        return view('workers.create', compact('projects', 'workerRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkerRequest $request)
    {
        $validated = $request->validated();

        $worker = Worker::create($validated);
        $worker->project()->attach($request->input('project_id', []));

        // Get the selected role ids from the input
        /*$roleIds = $request->input('worker_role_id', []);
        foreach ($roleIds as $roleId) {
            $worker->workerRoles()->attach($roleId);
        }*/

        // Get the selected role ids from the input
        $roleIds = [];
        if ($request->has('Operator')) {
            $roleIds[] = 1; // 1 is the ID of the Operator role
        }
        if ($request->has('Hoseman')) {
            $roleIds[] = 2; // 2 is the ID of the Hoseman role
        }
        if ($request->has('Extraman')) {
            $roleIds[] = 3; // 3 is the ID of the Extraman role
        }
        $worker->workerRoles()->attach($roleIds);

        return redirect()->route('workers.index')->with('success', 'Worker Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        return view('workers.view', compact('worker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        $projects = Project::select('id', 'project_name')->get();
        $workerRoles = WorkerRole::all();
        return view('workers.edit', [
            'projects' => $projects, 'workerRoles' => $workerRoles, 'worker' => $worker
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        $validated = $request->validated();

        $worker->update($validated);
        $worker->project()->sync($request->input('project_id', []));
        //$worker->workerRoles()->sync($request->input('worker_role_id', []));
        // Get the selected role ids from the input
        $roleIds = [];
        if ($request->has('Operator')) {
            $roleIds[] = 1; //assuming 'Operator' role id is 1
        }
        if ($request->has('Hoseman')) {
            $roleIds[] = 2; //assuming 'Hoseman' role id is 2
        }
        if ($request->has('Extraman')) {
            $roleIds[] = 3; //assuming 'Extraman' role id is 3
        }
        $worker->workerRoles()->sync($roleIds);
        return redirect()->route('workers.index')->with('success', 'Worker Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        $worker->project()->detach($worker);
        $worker->delete();
        return redirect()->route('workers.index')->with('success', 'Worker Deleted Suceessfully');
    }

    public function import(CSVFileRequest $request)
    {
        if ($request->file('file')) {
            $fileUpload = Excel::import(new WorkerImport, $request->file('file'));
        }

        if ($fileUpload) {
            return redirect()->route('workers.index')->with('success', 'Workers Imported Suceessfully');
        } else {
            return back()->with('error', 'Alert! file not uploaded');
        }
    }

    public function export(Request $request)
    {
        if ($request->download_type == 'all') {
            return Excel::download(new WorkerExport($request->download_type), 'workers.xlsx');
        }

        return Excel::download(new WorkerExport($request->download_type), 'workers.csv');
    }

    public function checkBookingWorker($workerId)
    {
        $booking_list = [];

        $workerOperator = Booking::where('worker_operator_id','=', $workerId)->select('booking_number')->get();
        $workerHoseman = Booking::where('worker_hoseman_id','=', $workerId)->select('booking_number')->get();
        $workerExtraman1 = Booking::where('worker_extraman1_id','=', $workerId)->select('booking_number')->get();
        $workerExtraman2 = Booking::where('worker_extraman2_id','=', $workerId)->select('booking_number')->get();
        $workerExtraman3 = Booking::where('worker_extraman3_id','=', $workerId)->select('booking_number')->get();

        foreach ($workerOperator as $key => $operator) {
            array_push($booking_list, $operator->booking_number);
        }

        foreach ($workerHoseman as $key => $hoseman) {
            array_push($booking_list, $hoseman->booking_number);
        }

        foreach ($workerExtraman1 as $key => $extraman1) {
            array_push($booking_list, $extraman1->booking_number);
        }

        foreach ($workerExtraman2 as $key => $extraman2) {
            array_push($booking_list, $extraman2->booking_number);
        }

        foreach ($workerExtraman3 as $key => $extraman3) {
            array_push($booking_list, $extraman3->booking_number);
        }


        return response()->json(['total_count' => count($booking_list), 'booking_list' => $booking_list]);
    }
}

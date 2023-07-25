<?php

namespace App\Http\Controllers;

use App\Models\Pump;
use App\Models\BoomPump;
use App\Models\LinePump;
use App\Exports\Pumps\PumpExport;
use App\Imports\PumpImport;
use Illuminate\Http\Request;
use App\Models\SumCubicMetre;
use App\Http\Requests\PumpRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CSVFileRequest;
use App\Http\Requests\UpdatePumpRequest;
use App\Models\PumpMake;

class PumpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pumps = Pump::with('pumpMake')->where([
            ['pump_name', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('registration', 'LIKE', '%' . $search . '%')
                        ->orWhere('location', 'LIKE', '%' . $search . '%');
                }
            }]
        ])

        ->orderBy('pump_name', 'asc')
        ->paginate(10);

        return view('pumps.index', compact('pumps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pumpMake = PumpMake::select('id','make')->get(); 
        return view('pumps.create', compact('pumpMake'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PumpRequest $request)
    {
        $validated = $request->validated();

        Pump::create($validated);
        return redirect()->route('pumps.index')->with('success', 'Pump Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pump $pump)
    {
        return view('pumps.view', compact('pump'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pump $pump)
    {
        $pumpMake = PumpMake::select('id','make')->get(); 
        return view('pumps.edit', compact('pump','pumpMake'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePumpRequest $request, Pump $pump)
    {
        $validated = $request->validated();
        $pump->update($validated);
        return redirect()->route('pumps.index')->with('success', 'Pump Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pump $pump)
    {
        $pump->delete();
        return redirect()->route('pumps.index')->with('success', 'Pump Deleted Suceessfully');
    }

    public function export(Request $request)
    {
        if($request->download_type == 'all'){
            return Excel::download(new PumpExport($request->download_type), 'pumps.xlsx');
        }
        return Excel::download(new PumpExport($request->download_type), 'pumps.csv');
    }

    public function import(CSVFileRequest $request)
    {
        if ($request->file('file')) {
            $fileUpload = Excel::import(new PumpImport, $request->file('file'));
        }

        if ($fileUpload) {
            return redirect()->route('pumps.index')->with('success', 'Pumps Data Imported Suceessfully');
        } else {
            return back()->with('error', 'Alert! file not uploaded');
        }        
    }

    public function getPumpTotalMetresPumped($id){
        $totalMetresPumped = SumCubicMetre::where('pump_id', $id)->sum('total_metres_pumped');
        return response()->json(['totalMetresPumped'=>$totalMetresPumped]);
    }

}

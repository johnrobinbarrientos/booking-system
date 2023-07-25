<?php

namespace App\Http\Controllers;

use App\Exports\ConcreteTypeExport;
use App\Models\ConcreteType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CSVFileRequest;
use App\Imports\ConcreteTypeImport;

class ConcreteTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $concreteTypes = ConcreteType::where([
            ['concrete_type', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->Where('concrete_type', 'LIKE', '%' . $search . '%');
                }
            }]
        ])
        ->orderBy('concrete_type', 'asc')
        ->paginate(10);
        return view('concreteTypes.index', compact('concreteTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('concreteTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'concrete_type' => 'required',
        ]);
        $concreteType = new ConcreteType();
        $concreteType->concrete_type = $request->concrete_type;
        $concreteType->save();
        return redirect()->route('concreteTypes.index')
            ->with('success', 'Concrete Type has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConcreteType  $concreteType
     * @return \Illuminate\Http\Response
     */
    public function show(ConcreteType $concreteType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConcreteType  $concreteType
     * @return \Illuminate\Http\Response
     */
    public function edit(ConcreteType $concreteType)
    {
        return view('concreteTypes.edit', compact('concreteType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConcreteType  $concreteType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConcreteType $concreteType)
    {
        $request->validate([
            'concrete_type' => 'required',
        ]);

        $concreteType->fill($request->post())->save();
        return redirect()->route('concreteTypes.index')->with('success', 'Concrete Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConcreteType  $concreteType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConcreteType $concreteType)
    {
        $concreteType->delete();
        return redirect()->route('concreteTypes.index')->with('success', 'Concrete Type Deleted Suceessfully');
    }

    public function export(Request $request) 
    {
        if($request->download_type == 'all'){
            return Excel::download(new ConcreteTypeExport($request->download_type), 'job_types.xlsx');
        }
        return Excel::download(new ConcreteTypeExport($request->download_type), 'job_types.csv');
    }

    public function import(CSVFileRequest $request)
    {
        if ($request->file('file')) {
            $fileUpload = Excel::import(new ConcreteTypeImport, $request->file('file'));
        }

        if ($fileUpload) {
            return redirect()->route('concreteTypes.index')->with('success', 'Concrete Types Imported Suceessfully');
        } else {
            return back()->with('error', 'Alert! file not uploaded');
        }
    }
}

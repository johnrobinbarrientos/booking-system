<?php

namespace App\Http\Controllers;

use App\Models\Subbie;
use Illuminate\Http\Request;
use App\Exports\SubbieExport;
use App\Http\Requests\SubbieRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CSVFileRequest;
use App\Imports\SubbieImport;

class SubbieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subbies = Subbie::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('contact_number', 'LIKE', '%' . $search . '%');
                        
                }
            }]
        ])
        ->orderBy('name', 'asc')
        ->paginate(10);

        return view('subbies.index', compact('subbies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subbies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubbieRequest $request)
    {
        Subbie::create($request->validated());
        return redirect()->route('subbies.index')->with('success', 'Subbie Added Successfully');   
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
    public function edit(Subbie $subby)
    {
        return view('subbies.edit', compact('subby'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubbieRequest $request, Subbie $subby)
    {
       
        $subby->fill($request->post())->save();
        return redirect()->route('subbies.index')->with('success', 'Subbie Updated Successfully');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subbie $subby)
    {
        $subby->delete();
        return redirect()->route('subbies.index')->with('success', 'Subbie Deleted Suceessfully');
    }

    public function export(Request $request) 
    {
        if($request->download_type == 'all'){
            return Excel::download(new SubbieExport($request->download_type), 'subbies.xlsx');
        }
        return Excel::download(new SubbieExport($request->download_type), 'subbies.csv');
    }

    public function import(CSVFileRequest $request)
    {
        if ($request->file('file')) {
            $fileUpload = Excel::import(new SubbieImport, $request->file('file'));
        }

        if ($fileUpload) {
            return redirect()->route('subbies.index')->with('success', 'Subbie Data Imported Suceessfully');
        } else {
            return back()->with('error', 'Alert! file not uploaded');
        }
    }
}

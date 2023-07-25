<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConcreteSupplier;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CSVFileRequest;
use App\Exports\ConcreteSupplierExport;
use App\Imports\ConcreteSupplierImport;

class ConcreteSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $concreteSuppliers = ConcreteSupplier::where([
            ['concrete_supplier', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->Where('concrete_supplier', 'LIKE', '%' . $search . '%');
                }
            }]
        ])

        ->orderBy('concrete_supplier', 'asc')
        ->paginate(10);
        return view('concreteSuppliers.index', compact('concreteSuppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('concreteSuppliers.create');
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
            'concrete_supplier' => 'required',
        ]);
        $concreteSupplier = new ConcreteSupplier();
        $concreteSupplier->concrete_supplier = $request->concrete_supplier;
        $concreteSupplier->save();
        return redirect()->route('concreteSuppliers.index')
            ->with('success', 'Concrete Supplier has been created successfully.');
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
    public function edit(ConcreteSupplier $concreteSupplier)
    {
        return view('concreteSuppliers.edit', compact('concreteSupplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConcreteSupplier $concreteSupplier)
    {
        $request->validate([
            'concrete_supplier' => 'required',
        ]);

        $concreteSupplier->fill($request->post())->save();
        return redirect()->route('concreteSuppliers.index')->with('success', 'Concrete Supplier Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConcreteSupplier $concreteSupplier)
    {
        $concreteSupplier->delete();
        return redirect()->route('concreteSuppliers.index')->with('success', 'Concrete Supplier Deleted Suceessfully');
    }

    public function export(Request $request) 
    {
        if($request->download_type == 'all'){
            return Excel::download(new ConcreteSupplierExport($request->download_type), 'concrete_suppliers.xlsx');
        }
        return Excel::download(new ConcreteSupplierExport($request->download_type), 'concrete_suppliers.csv');
    }

    public function import(CSVFileRequest $request)
    {
        if ($request->file('file')) {
            $fileUpload = Excel::import(new ConcreteSupplierImport, $request->file('file'));
        }

        if ($fileUpload) {
            return redirect()->route('concreteSuppliers.index')->with('success', 'Suppliers Imported Suceessfully');
        } else {
            return back()->with('error', 'Alert! file not uploaded');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PumpMake;
use Illuminate\Http\Request;

class PumpMakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pumpMakes = PumpMake::where([
            ['make', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('make', 'LIKE', '%' . $search . '%');
                }
            }]
        ])
        ->orderBy('make', 'asc')
        ->paginate(10);

        return view('pumpMake.index', compact('pumpMakes'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pumpMake.create');
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
            'make' => 'required',
        ]);
        $pumpMake = new PumpMake();
        $pumpMake->make = $request->make;
        $pumpMake->save();
        return redirect()->route('pumpMake.index')
            ->with('success', 'Pump Make has been created successfully.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PumpMake  $pumpMake
     * @return \Illuminate\Http\Response
     */
    public function show(PumpMake $pumpMake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PumpMake  $pumpMake
     * @return \Illuminate\Http\Response
     */
    public function edit(PumpMake $pumpMake)
    {
        return view('pumpMake.edit', compact('pumpMake'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PumpMake  $pumpMake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PumpMake $pumpMake)
    {
        $request->validate([
            'make' => 'required',
        ]);

        $pumpMake->fill($request->post())->save();
        return redirect()->route('pumpMake.index')->with('success', 'Pump Make Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PumpMake  $pumpMake
     * @return \Illuminate\Http\Response
     */
    public function destroy(PumpMake $pumpMake)
    {
        $pumpMake->delete();
        return redirect()->route('pumpMake.index')->with('success', 'Make Deleted Suceessfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PriceGroup;
use App\Exports\PumpExport;
use Illuminate\Http\Request;
use App\Http\Requests\PriceGroupRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CSVFileRequest;
use App\Http\Requests\UpdatePumpRequest;

class PriceGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $priceGroups = PriceGroup::where([
            ['location_name', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->where('location_name', 'LIKE', '%' . $search . '%')
                        ->get();
                }
            }]
        ])
        ->orderBy('location_name', 'asc')
        ->paginate(10);

        return view('priceGroup.index', compact('priceGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('priceGroup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PriceGroupRequest $request)
    {
        $validated = $request->validated();

        PriceGroup::create($validated);
        return redirect()->route('price-groups.index')->with('success', 'Price Group Added Successfully');
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
    public function edit(PriceGroup $priceGroup)
    {
        return view('priceGroup.edit', compact('priceGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PriceGroupRequest $request, PriceGroup $priceGroup)
    {
        $validated = $request->validated();

        $priceGroup->update($validated);

        return redirect()->route('price-groups.index')->with('success', 'Price Group Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceGroup $priceGroup)
    {
        $priceGroup->delete();
        return redirect()->route('price-groups.index')->with('success', 'Price Group Deleted Suceessfully');
    }

    public function getPriceGroupDetails($priceGroupId)
    {
        $priceGroup = PriceGroup::find($priceGroupId);
        $data = [
            'cement_bag' => $priceGroup->cement_bag,
            'washout_bag_cost' => $priceGroup->washout_bag,
            'pipeline_extension' => $priceGroup->pipeline_extension,
            'additional_man_per_hour' => $priceGroup->additional_man_per_hour,
            'offsite_clean_out' => $priceGroup->offsite_clean_out,
            'overtime_per_hour_per_man' => $priceGroup->overtime_per_hour_per_man,
            'travel' => $priceGroup->travel,
        ];
        return response()->json($data);
    }
}

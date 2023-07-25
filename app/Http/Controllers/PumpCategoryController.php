<?php

namespace App\Http\Controllers;

use App\Models\PumpCategory;
use Illuminate\Http\Request;
use App\Http\Requests\PumpCategoryRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CSVFileRequest;
use App\Http\Requests\UpdatePumpRequest;

class PumpCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pumpCategories = PumpCategory::where([
            ['category_name', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->where('category_name', 'LIKE', '%' . $search . '%')
                        ->get();
                }
            }]
        ])
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('pumpCategory.index', compact('pumpCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pumpCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PumpCategoryRequest $request)
    {
        $validated = $request->validated();

        PumpCategory::create($validated);
        return redirect()->route('pump-categories.index')->with('success', 'Pump  Category Added Successfully');
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
    public function edit(PumpCategory $pumpCategory)
    {
        return view('pumpCategory.edit', compact('pumpCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PumpCategoryRequest $request, PumpCategory $pumpCategory)
    {
        $validated = $request->validated();

        $pumpCategory->update($validated);

        return redirect()->route('pump-categories.index')->with('success', 'Price Group Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PumpCategory $pumpCategory)
    {
        $pumpCategory->delete();
        return redirect()->route('pump-categories.index')->with('success', 'Pump Category Deleted Suceessfully');
    }

}

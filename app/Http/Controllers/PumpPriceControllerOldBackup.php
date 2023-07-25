<?php

namespace App\Http\Controllers;

use App\Models\PumpPrice;
use App\Models\PriceGroup;
use App\Models\PumpCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PumpPriceRequest;

class PumpPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = PumpPrice::with('priceGroup','pumpCategory');
        if (($search = $request->search)) {
            $query->where(function ($query) use ($search){
                $query->orWhereHas('priceGroup', function($q) use ($search){
                    $q->where('location_name', 'LIKE', '%' . $search . '%');
                });

                $query->orWhereHas('pumpCategory', function($q) use ($search){
                    $q->Where('category_name', 'LIKE', '%' . $search . '%');
                });
            });
            
        }

        $pumpPrices = $query->orderBy('id', 'desc')->paginate(10);

        return view('pumpPrice.index', compact('pumpPrices'));
    }

    public function hist(PumpPrice $pumpPrice)
    {
        $activities = $pumpPrice->activities()->latest()->get();
        
        return view('pumpPrice.hist', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priceGroups = PriceGroup::all();
        $pumpCategories = PumpCategory::all();
        return view('pumpPrice.create',compact('priceGroups','pumpCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PumpPriceRequest $request)
    {
        $validated = $request->validated();
        PumpPrice::create($validated + ['user_id' => Auth::id()]);
        return redirect()->route('pump-prices.index')->with('success', 'Pump Price Added Successfully');
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
    public function edit(PumpPrice $pumpPrice)
    {
        $priceGroups = PriceGroup::all();
        $pumpCategories = PumpCategory::all();
        return view('pumpPrice.edit',compact('priceGroups','pumpCategories','pumpPrice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PumpPriceRequest $request,PumpPrice $pumpPrice)
    {
        $validated = $request->validated();

        $pumpPrice->update($validated);

        return redirect()->route('pump-prices.index')->with('success', 'Pump Price Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PumpPrice $pumpPrice)
    {
        $pumpPrice->delete();
        return redirect()->route('pump-prices.index')->with('success', 'Pump Price Deleted Suceessfully');
    }

    public function getPumpPriceList(Request $request){
        $priceGroups = PriceGroup::all();
        $pumpCategories = PumpCategory::all();

        $pumpPrices = PumpPrice::with('priceGroup','pumpCategory')->where('price_group_id',$request->price_group_id)->where('pump_category_id',$request->pump_category_id)->get();
        return response()->json(['pumpPrices'=>$pumpPrices]);
    }

    public function getPumpPrice($id){
        $pumpPrice = PumpPrice::find($id);
        return response()->json(['pumpPrice'=>$pumpPrice]);
    }
}

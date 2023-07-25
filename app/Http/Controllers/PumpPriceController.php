<?php

namespace App\Http\Controllers;

use App\Models\PumpPrice;
use App\Models\PriceGroup;
use App\Models\PumpCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PumpPriceRequest;
use Spatie\Activitylog\Models\Activity;

class PumpPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $query = PumpPrice::with('priceGroup','pumpCategory');
        // if (($search = $request->search)) {
        //     $query->where(function ($query) use ($search){
        //         $query->orWhereHas('priceGroup', function($q) use ($search){
        //             $q->where('location_name', 'LIKE', '%' . $search . '%');
        //         });

        //         $query->orWhereHas('pumpCategory', function($q) use ($search){
        //             $q->Where('category_name', 'LIKE', '%' . $search . '%');
        //         });
        //     });

        // }

        // $pumpPrices = $query->orderBy('id', 'desc')->paginate(10);

        $priceGroups = PriceGroup::all();
        //$pumpPrices = PumpPrice::all();

        return view('pumpPrice.index', compact('priceGroups'));
    }

    /*public function hist(PumpPrice $pumpPrice)
    {
        $activities = $pumpPrice->activities()->latest()->get();
        
        return view('pumpPrice.hist', compact('activities'));
    }*/

    public function hist()
    {
        $user = auth()->user();

        $activities = Activity::whereIn('event', ['created', 'updated'])
            ->where('log_name', '=', 'default')
            ->where('subject_type', '=', PumpPrice::class)
            ->with(['causer', 'subject'])
            ->orderByDesc('created_at')
            ->paginate(10);

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


        return view('pumpPrice.create', compact('priceGroups', 'pumpCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validated = $request->validated();

        // PumpPrice::create($validated + ['user_id' => Auth::id()]);
        // return redirect()->route('pump-prices.index')->with('success', 'Pump Price Added Successfully');

        $priceGroup = array(
            'location_name' => $request->price_group,
            'additional_man_per_hour' => !empty($request->additional_man_per_hour) ? $request->additional_man_per_hour : 0,
            'overtime_per_hour_per_man' => !empty($request->overtime_per_hour_per_man) ? $request->overtime_per_hour_per_man : 0,
            'offsite_clean_out' => !empty($request->offsite_clean_out) ? $request->offsite_clean_out : 0,
            'cement_bag' => !empty($request->cement_bag) ? $request->cement_bag : 0,
            'pipeline_extension' => !empty($request->pipeline_extension) ? $request->pipeline_extension : 0,
            'washout_bag' => !empty($request->washout_bag) ? $request->washout_bag : 0,
            'travel' => !empty($request->travel) ? $request->travel : 0,
        );

        $priceGroupCreated = PriceGroup::create($priceGroup);

        $pumpCategory = PumpCategory::where('category_name', 'Boom Pump')->first();

        $size = array('50/47', '45', '40/38', '37/36', '32/33', '28');

        if (!empty($request->min_hire)) {
            for ($i = 0; $i < count($request->min_hire); $i++) {

                $pumpPrice = PumpPrice::where('price_group_id', $priceGroupCreated->id)->where('pump_category_id', $pumpCategory->id)->where('size', $size[$i])->first();
                if (empty($pumpPrice)) {
                    $pumpPrice = new PumpPrice();
                }
                $pumpPrice->price_group_id = $priceGroupCreated->id;
                $pumpPrice->pump_category_id = $pumpCategory->id;
                $pumpPrice->size = $size[$i];
                $pumpPrice->min_hire_first_2_hours_on_site = !empty($request->min_hire[$i]) ? $request->min_hire[$i] : 0;
                $pumpPrice->extra_time_per_hour = !empty($request->extra_time[$i]) ? $request->extra_time[$i] : 0;
                $pumpPrice->per_cube_meter_of_concrete = !empty($request->m3[$i]) ? $request->m3[$i] : 0;
                $pumpPrice->user_id = Auth::id(); // saving user_id in pump_prices table
                $pumpPrice->save();
            }
        }

        $pumpCategory = PumpCategory::where('category_name', 'Line Pump')->first();
        $pumpPrice = PumpPrice::where('price_group_id', $priceGroupCreated->id)->where('pump_category_id', $pumpCategory->id)->first();
        if (empty($pumpPrice)) {
            $pumpPrice = new PumpPrice();
        }
        $pumpPrice->price_group_id = $priceGroupCreated->id;
        $pumpPrice->pump_category_id = $pumpCategory->id;
        $pumpPrice->min_hire_first_2_hours_on_site = !empty($request->line_pump_min_hire) ? $request->line_pump_min_hire : 0;
        $pumpPrice->extra_time_per_hour = !empty($request->line_pump_extra_time) ? $request->line_pump_extra_time : 0;
        $pumpPrice->per_cube_meter_of_concrete = !empty($request->line_pump_m3) ? $request->line_pump_m3 : 0;
        $pumpPrice->user_id = Auth::id(); // saving user_id in pump_prices table
        $pumpPrice->save();

        // $pumpPrices = PumpPrice::where('price_group_id',$job->price_group_id)->where('pump_category_id',$job->pump_category_id)->pluck('id');

        // $job->pumpPrice()->attach($pumpPrices);

        return redirect()->route('pump-prices.index')->with('success', 'Job Added Successfully');
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
    public function edit($id) // PumpPrice $pumpPrice
    {
        $priceGroup = PriceGroup::find($id);

        $pumpCategory = PumpCategory::where('category_name', 'Boom Pump')->first();
        $boomPumps = PumpPrice::select('size', 'min_hire_first_2_hours_on_site', 'extra_time_per_hour', 'per_cube_meter_of_concrete')->where('price_group_id', $id)->where('pump_category_id', $pumpCategory->id)->get();
        // echo "<pre>";print_r($boomPumps);echo "</pre>";

        $pumpCategory = PumpCategory::where('category_name', 'Line Pump')->first();
        $linePump = PumpPrice::where('price_group_id', $priceGroup->id)->where('pump_category_id', $pumpCategory->id)->first();

        // $pumpCategories = PumpCategory::all();
        return view('pumpPrice.edit', compact('priceGroup', 'boomPumps', 'linePump'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validated = $request->validated();

        // $pumpPrice->update($validated);

        // return redirect()->route('pump-prices.index')->with('success', 'Pump Price Updated Successfully');

        $priceGroup = PriceGroup::find($id);
        $data = array(
            'location_name' => $request->price_group,
            'additional_man_per_hour' => !empty($request->additional_man_per_hour) ? $request->additional_man_per_hour : 0,
            'overtime_per_hour_per_man' => !empty($request->overtime_per_hour_per_man) ? $request->overtime_per_hour_per_man : 0,
            'offsite_clean_out' => !empty($request->offsite_clean_out) ? $request->offsite_clean_out : 0,
            'cement_bag' => !empty($request->cement_bag) ? $request->cement_bag : 0,
            'pipeline_extension' => !empty($request->pipeline_extension) ? $request->pipeline_extension : 0,
            'washout_bag' => !empty($request->washout_bag) ? $request->washout_bag : 0,
            'travel' => !empty($request->travel) ? $request->travel : 0,
        );
        $priceGroup->update($data);

        $pumpCategory = PumpCategory::where('category_name', 'Boom Pump')->first();

        $size = array('50/47', '45', '40/38', '37/36', '32/33', '28');

        if (!empty($request->min_hire)) {
            for ($i = 0; $i < count($request->min_hire); $i++) {

                $pumpPrice = PumpPrice::where('price_group_id', $priceGroup->id)->where('pump_category_id', $pumpCategory->id)->where('size', $size[$i])->first();
                if (empty($pumpPrice)) {
                    $pumpPrice = new PumpPrice();
                }
                $pumpPrice->price_group_id = $priceGroup->id;
                $pumpPrice->pump_category_id = $pumpCategory->id;
                $pumpPrice->size = $size[$i];
                $pumpPrice->min_hire_first_2_hours_on_site = !empty($request->min_hire[$i]) ? $request->min_hire[$i] : 0;
                $pumpPrice->extra_time_per_hour = !empty($request->extra_time[$i]) ? $request->extra_time[$i] : 0;
                $pumpPrice->per_cube_meter_of_concrete = !empty($request->m3[$i]) ? $request->m3[$i] : 0;
                $pumpPrice->save();
            }
        }

        $pumpCategory = PumpCategory::where('category_name', 'Line Pump')->first();
        $pumpPrice = PumpPrice::where('price_group_id', $priceGroup->id)->where('pump_category_id', $pumpCategory->id)->first();
        if (empty($pumpPrice)) {
            $pumpPrice = new PumpPrice();
        }
        $pumpPrice->price_group_id = $priceGroup->id;
        $pumpPrice->pump_category_id = $pumpCategory->id;
        $pumpPrice->min_hire_first_2_hours_on_site = !empty($request->line_pump_min_hire) ? $request->line_pump_min_hire : 0;
        $pumpPrice->extra_time_per_hour = !empty($request->line_pump_extra_time) ? $request->line_pump_extra_time : 0;
        $pumpPrice->per_cube_meter_of_concrete = !empty($request->line_pump_m3) ? $request->line_pump_m3 : 0;
        $pumpPrice->save();

        // $pumpPrices = PumpPrice::where('price_group_id',$job->price_group_id)->where('pump_category_id',$job->pump_category_id)->pluck('id');

        // $job->pumpPrice()->attach($pumpPrices);

        return redirect()->route('pump-prices.index')->with('success', 'Pricing updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PumpPrice::where('price_group_id', $id)->forceDelete();

        $priceGroup = PriceGroup::find($id);
        $priceGroup->forceDelete();

        return redirect()->route('pump-prices.index')->with('success', 'Pump Price Deleted Suceessfully');
    }

    public function getPumpPriceList(Request $request)
    {
        $priceGroups = PriceGroup::all();
        $pumpCategories = PumpCategory::all();

        $pumpPrices = PumpPrice::with('priceGroup', 'pumpCategory')->where('price_group_id', $request->price_group_id)->where('pump_category_id', $request->pump_category_id)->get();
        return response()->json(['pumpPrices' => $pumpPrices]);
    }

    public function getPumpPrice($id)
    {
        $pumpPrice = PumpPrice::find($id);
        return response()->json(['pumpPrice' => $pumpPrice]);
    }
}

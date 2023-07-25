@extends('../layout/' . $layout)

@section('subhead')
    <title>Pricing Table| Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h1 class="text-lg font-medium truncate mr-5">Update Pricing Table</h1>
                </div>
                <div>
                    <form action="{{route('pump-prices.update',$priceGroup->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col mt-8">
                            <label for="" class="mb-2">Pricing Group Name</label>
                            <input type="text" name="price_group" class="form-control w-1/2" id="price_group" required="required" value="@if(!empty($priceGroup->location_name)){{$priceGroup->location_name}}@endif">
                        </div>

                        <div class="mt-6">
                            <div class="w-full">
                               
                            </div>
                            <div class>
                                <h2 class="text-lg font-medium mt-4">Pricing per pump size</h2>
                                <div>
                                    <table class="table">
                                        <thead class="p-6">
                                            <tr class="text-center">
                                                <th></th>
                                                <th class="p-6">50/47</th>
                                                <th class="p-6">45</th>
                                                <th class="p-6">40/38</th>
                                                <th class="p-6">37</th>
                                                <th class="p-6">32/33</th>
                                                <th class="p-6">28</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td class="font-medium">Min Hire</td>
                                                @if(count($boomPumps)>0)
                                                @foreach($boomPumps as 
                                                $boomPump)
                                                    <td>
                                                        <input type="text" class="w-3/4 form-control" name="min_hire[]" required="required" value="{{$boomPump->min_hire_first_2_hours_on_site}}">
                                                    </td>
                                                @endforeach
                                                @else
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="min_hire[]" required="required" >
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="min_hire[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="min_hire[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="min_hire[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="min_hire[]" required="required" >
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="min_hire[]" required="required">
                                                </td>             
                                                @endif      
                                            </tr>
                                            <tr class="text-center">
                                                <td class="font-medium">extra time</td>
                                                @if(count($boomPumps)>0)
                                                @foreach($boomPumps as 
                                                $boomPump)
                                                    <td>
                                                        <input type="text" class="w-3/4 form-control" name="extra_time[]" required="required" value="{{$boomPump->extra_time_per_hour}}">
                                                    </td>
                                                @endforeach
                                                @else
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="extra_time[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="extra_time[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="extra_time[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="extra_time[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="extra_time[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="extra_time[]" required="required">
                                                </td>
                                                  
                                                @endif
                                            </tr>
                                            <tr class="text-center">
                                                <td class="font-medium">per m3</td>
                                                @if(count($boomPumps)>0)
                                                @foreach($boomPumps as 
                                                $boomPump)
                                                    <td>
                                                        <input type="text" class="w-3/4 form-control" name="m3[]" required="required" value="{{$boomPump->per_cube_meter_of_concrete}}">
                                                    </td>
                                                @endforeach
                                                @else
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="m3[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="m3[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="m3[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="m3[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="m3[]" required="required">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4 form-control" name="m3[]" required="required">
                                                </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table w-1/4">
                                        <thead class="p-6">
                                            <tr class="text-center">
                                                <th></th>
                                                <th>Line Pump</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td class="font-medium">Min Hire</td>
                                                <td>
                                                    <input type="text" class="w-1/4 form-control" name="line_pump_min_hire" required="required"
value="@if(!empty($linePump->min_hire_first_2_hours_on_site)){{$linePump->min_hire_first_2_hours_on_site}}@endif" 
                                                    >
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td class="font-medium">Extra time</td>
                                                <td>
                                                    <input type="text" class="w-1/4 form-control" name="line_pump_extra_time" required="required"
value="@if(!empty($linePump->extra_time_per_hour)){{$linePump->extra_time_per_hour}}@endif">
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td class="font-medium">per m3</td>
                                                <td>
                                                    <input type="text" class="w-1/4 form-control" name="line_pump_m3" required="required" value="@if(!empty($linePump->per_cube_meter_of_concrete)){{$linePump->per_cube_meter_of_concrete}}@endif">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="flex text-center mt-4 w-full space-x-8">
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Additional Man per hour</label>
                                            <input type="text" class="form-control" name="additional_man_per_hour" value="@if(!empty($priceGroup->additional_man_per_hour)){{$priceGroup->additional_man_per_hour}}@endif">
                                        </div>
                                        <div class="w-33 flex flex-col mr-4 ml-4 ">
                                            <label for=""> Overtime per hour</label>
                                            <input type="text" class="form-control" name="overtime_per_hour_per_man" value="@if(!empty($priceGroup->overtime_per_hour_per_man)){{$priceGroup->overtime_per_hour_per_man}}@endif">
                                        </div>
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Offsite clean out</label>
                                            <input type="text" class="form-control" name="offsite_clean_out" value="@if(!empty($priceGroup->offsite_clean_out)){{$priceGroup->offsite_clean_out}}@endif">
                                        </div>
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Travel</label>
                                            <input type="text" class="form-control" name="travel" value="@if(!empty($priceGroup->travel)){{$priceGroup->travel}}@endif">
                                        </div>
                                    </div>
                                    <div class="flex text-center mt-4 w-full space-x-8">
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Cement Bag</label>
                                            <input type="text" class="form-control" name="cement_bag" value="@if(!empty($priceGroup->cement_bag)){{$priceGroup->cement_bag}}@endif">
                                        </div>
                                        <div class="w-1/4 flex flex-col mr-4 ml-4 ">
                                            <label for=""> Pipeline Extension</label>
                                            <input type="text" class="form-control" name="pipeline_extension" value="@if(!empty($priceGroup->pipeline_extension)){{$priceGroup->pipeline_extension}}@endif">
                                        </div>
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Washout Bag</label>
                                            <input type="text" class="form-control" name="washout_bag" value="@if(!empty($priceGroup->washout_bag)){{$priceGroup->washout_bag}}@endif">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

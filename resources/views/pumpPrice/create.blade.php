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
                    <h1 class="text-lg font-medium truncate mr-5">New Pricing Table</h1>
                </div>
                <div>
                    <form action="{{route('pump-prices.store')}}" method="POST">
                        @csrf
                        <div class="flex flex-col mt-8">
                            <label for="" class="mb-2">Pricing Group Name</label>
                            <input type="text" name="price_group" class="form-control w-1/2" id="price_group" required="required">
                        </div>

                        <div class="mt-6">
                            <div class="w-full">
                            </div>
                            <div class>
                                <h2 class="text-lg font-medium mt-4">Pricing per pump size</h2>
                                <div>
                                    <table class="table table-striped mt-5">
                                        <thead class="p-6">
                                            <tr class="">
                                                <th></th>
                                                <th class="p-6">50/47</th>
                                                <th class="p-6">45</th>
                                                <th class="p-6">40/38</th>
                                                <th class="p-6">37/36</th>
                                                <th class="p-6">32/33</th>
                                                <th class="p-6">28</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="">
                                                <td class="font-medium">Min Hire</td>
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
                                            </tr>
                                            <tr class="">
                                                <td class="font-medium">Extra Time</td>
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
                                            </tr>
                                            <tr class="">
                                                <td class="font-medium">Per M3</td>
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
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table flex text-center mt-5">
                                        <thead class="p-6">
                                            <tr class="flex justify-start">
                                                <th></th>
                                                <th class="flex justify-start">Line Pump</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                                <tr class="flex self-start">
                                                    <td class="font-medium">Min Hire</td>
                                                    <td class="ml-5">
                                                        <input type="text" class="w-full form-control" name="line_pump_min_hire" required="required">
                                                    </td>
                                                </tr>
                                                <tr class="flex self-start">
                                                    <td class="font-medium">Extra Time</td>
                                                    <td class="ml-1">
                                                        <input type="text" class="w-full form-control" name="line_pump_extra_time" required="required">
                                                    </td>
                                                </tr>
                                                <tr class="flex self-start">
                                                    <td class="font-medium">Per M3</td>
                                                    <td class="ml-6">
                                                        <input type="text" class="w-full form-control" name="line_pump_m3" required="required">
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                    <div class="flex text-center mt-4 w-full space-x-8">
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Additional Man Per Hour</label>
                                            <input type="text" class="form-control" name="additional_man_per_hour">
                                        </div>
                                        <div class="w-1/4 flex flex-col mr-4 ml-4 ">
                                            <label for=""> Overtime Per Hour</label>
                                            <input type="text" class="form-control" name="overtime_per_hour_per_man">
                                        </div>
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Offsite Clean Out</label>
                                            <input type="text" class="form-control" name="offsite_clean_out">
                                        </div>
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Travel</label>
                                            <input type="text" class="form-control" name="travel">
                                        </div>
                                    </div>
                                    <div class="flex text-center mt-4 w-full space-x-8">
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Cement Bag</label>
                                            <input type="text" class="form-control" name="cement_bag">
                                        </div>
                                        <div class="w-1/4 flex flex-col mr-4 ml-4 ">
                                            <label for=""> Pipeline Extension</label>
                                            <input type="text" class="form-control" name="pipeline_extension">
                                        </div>
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Washout Bag</label>
                                            <input type="text" class="form-control" name="washout_bag">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn py-3 btn-primary w-full md:w-52 mt-5">Save</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('../layout/' . $layout)

@section('subhead')
    <title>New Pump | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Create A Pump</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12 2xl:col-span-12">
            <!-- BEGIN: Add new Client -->
            <div class="intro-y box p-5">
                <div class="p-5">
                    <h2 class="text-xl"> Pump Details</h2>
                    <form action="{{ route('pumps.store') }}" method="POST" class="w-full">
                        @csrf
                        <fieldset class=" w-full mr-6">
                            <div class="flex">
                                <div class=" w-1/3 pt-4 mr-6">
                                    <div class="flex flex-col pt-4">
                                        <label class="">
                                            <span class="text-gray-700">Pump Name *</span>
                                            <input name="pump_name" value="{{ old('pump_name') }}" type="text"
                                                class="form-control">
                                        </label>
                                        @error('pump_name')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Plant Number *</span>
                                            <input name="plant_number" value="{{ old('plant_number') }}" type="text"
                                                class="form-control">
                                        </label>
                                        @error('plant_number')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Registration *</span>
                                            <input name="registration" value="{{ old('registration') }}" type="text"
                                                class="form-control">
                                        </label>
                                        @error('registration')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Location</span>
                                            <input name="location" value="{{ old('location') }}" type="text"
                                                class="form-control">
                                        </label>
                                        @error('location')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Year</span>
                                            <!--<input id="year" name="year" value="{{ old('year') }}" type="text"
                                                class="form-control">-->
                                                <select name="year" class="form-control">
                                                    <option selected disabled>Select Year</option>
                                                    <?php
                                                    $startYear = date('Y') - 50; //50 years back
                                                    $endYear = date('Y');
                                                    for ($year = $startYear; $year <= $endYear; $year++) {
                                                        echo '<option value="' . $year . '">' . $year . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                        </label>
                                        @error('year')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" w-1/3 pt-4 mr-6">
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Make</span>
                                                <select name="pump_make_id" class="form-control">
                                                    <option value="" selected disabled>Select Pump Make</option>
                                                    @foreach ($pumpMake as $make)
                                                    <option value="{{$make->id}}">{{$make->make}}</option> 
                                                    @endforeach
                                                </select>
                                        </label>
                                        @error('pump_make_id')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Model</span>
                                            <input name="model" value="{{ old('model') }}" type="text"
                                                class="form-control">
                                        </label>
                                        @error('model')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Concrete Pumped (Opening Balance)</span>
                                            <input name="concrete_pumped_opening_balance" value="{{ old('concrete_pumped_opening_balance') }}" type="text"
                                                class="form-control">
                                        </label>
                                        @error('concrete_pumped_opening_balance')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Serial No</span>
                                            <input name="serial_no" value="{{ old('serial_no') }}" type="text"
                                                class="form-control">
                                        </label>
                                        @error('serial_no')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Worksafe No</span>
                                            <input name="worksafe_no" value="{{ old('worksafe_no') }}" type="text"
                                                class="form-control">
                                        </label>
                                        @error('worksafe_no')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" w-1/3 pt-4 mr-6">
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Pump Status</span>
                                                <select name="status" class="form-control" required="required">
                                                    <option selected disabled>Select Status</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                </select>
                                        </label>
                                        @error('status')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Notes</span>
                                                <textarea class="form-control" name="notes" cols="20" rows="8"></textarea>
                                        </label>
                                        @error('notes')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col pt-4">
                                        <label for="">
                                            <span class="text-gray-700">Pump Docket Number *</span>
                                            <input name="pump_docket_number" value="{{ old('pump_docket_number') }}" type="text"
                                                class="form-control">
                                        </label>
                                        @error('pump_docket_number')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="flex justify-end flex-col md:flex-row gap-2 mt-10">
                         <a href="{{ route('pumps.index') }} "
                             class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                         <button type="submit"
                             class="btn py-3 btn-primary w-full md:w-52">Save
                             &
                             Add New Pump</button>
                        </div>
                    </form>         
               </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection


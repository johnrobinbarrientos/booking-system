@extends('../layout/' . $layout)

@section('subhead')
    <title>Pump Details | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Pump Details</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12 2xl:col-span-12">
            <!-- BEGIN: Add new Client -->
            <div class="intro-y box p-5">
                <div class="p-5">
                    <h2 class="text-xl"> Pump Details</h2>
                    <fieldset class=" w-full mr-6">
                        <div class="flex">
                            <div class=" w-1/3 pt-4 mr-6">
                                <div class="flex flex-col pt-4">
                                    <label class="">
                                        <span class="text-gray-700">Pump Name</span>
                                        <input name="pump_name" value="{{ $pump->pump_name }}" type="text"
                                            class="form-control">
                                    </label>
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Plant Number</span>
                                        <input name="plant_number" value="{{ $pump->plant_number }}" type="text"
                                            class="form-control">
                                    </label>
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Registration</span>
                                        <input name="registration" value="{{ $pump->registration }}" type="text"
                                            class="form-control">
                                    </label>
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Location</span>
                                        <input name="location" value="{{ $pump->location }}" type="text"
                                            class="form-control">
                                    </label>

                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Year</span>
                                        <input id="year" name="year" value="{{ $pump->year }}" type="text"
                                            class="form-control">
                                    </label>

                                </div>
                            </div>
                            <div class=" w-1/3 pt-4 mr-6">
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Make</span>
                                        <input name="make" value="{{ $pump->make }}" type="text"
                                            class="form-control">
                                    </label>

                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Model</span>
                                        <input name="model" value="{{ $pump->model }}" type="text"
                                            class="form-control">
                                    </label>

                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Concrete Pumped (Opening Balance)</span>
                                        <input name="concrete_pumped_opening_balance" value="{{ $pump->concrete_pumped_opening_balance }}" type="text"
                                            class="form-control">
                                    </label>

                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Serial No</span>
                                        <input name="serial_no" value="{{ $pump->serial_no }}" type="text"
                                            class="form-control">
                                    </label>

                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Worksafe No</span>
                                        <input name="worksafe_no" value="{{ $pump->worksafe_no }}" type="text"
                                            class="form-control">
                                    </label>

                                </div>
                            </div>
                            <div class=" w-1/3 pt-4 mr-6">
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Pump Status</span>
                                        <input class="form-control" type="text" name=""
                                            value="{{ $pump->status }}">
                                    </label>

                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Notes</span>
                                        <textarea class="form-control" name="notes" cols="20" rows="10">{{ $pump->notes }}</textarea>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="flex justify-end flex-col md:flex-row gap-2 mt-10">
                        <a href="{{ route('pumps.index') }} "
                            class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Back to
                            Pumps</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const formElements = document.querySelectorAll('input, select, textarea');
        formElements.forEach(element => {
            element.style.border = 'none';
        });
    </script>
@endsection

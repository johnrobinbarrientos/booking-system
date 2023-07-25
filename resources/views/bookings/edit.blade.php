@extends('../layout/' . $layout)

@section('subhead')
    <title>Update a Booking | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Update Booking</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12 2xl:col-span-12">
            <!-- BEGIN: Uplaod Product -->
            <div class="intro-y box p-5" id="update-booking-div">
                <div class="p-5">
                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="w-full">
                        @csrf
                        @method('PUT')
                        <fieldset class="flex w-full pt-4">
                            <fieldset class="w-1/2 mr-6">
                                <div class="w-full pt-4">
                                    <label for="">Customer Order Number</label>
                                    <input type="text" name="customer_order_number" id="customer_order_number" value="{{ $booking->customer_order_number }}"
                                        class="form-control w-full text-success" style="font-size: 16px">
                                </div>
                                <div class="w-full pt-4">
                                    <label for="">Booking Number</label>
                                    <input type="text" name="booking_number" id="booking_number" value="{{ $booking->booking_number }}"
                                        class="form-control w-full text-success" style="font-size: 16px" readonly>
                                </div>
                                <br>
                                <h2 class="text-xl text-primary">Client Details</h2>
                                <div class="flex pt-4">
                                    <div class="flex flex-col w-1/2 mr-4">
                                        <label for="">Client</label>
                                        <select name="client_id" id="client_id" class="form-control w-100">
                                            <option selected value=0>NONE</option>
                                            @foreach ($clients as $client)
                                                <option @selected($client->id == $booking->client_id) value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="flex pt-4">
                                    <div class="flex-col w-1/2 ">
                                        <input id="is_subbie_required" type="checkbox" checked="false" name="is_subbie_required" class="form-check-input">
                                        <label for="is-subbie-required">Is Subbie Required?</label>
                                    </div>
                                </div>
                                <div class="flex pt-4" id="subbie_preview">
                                    <div class="flex flex-col w-1/2 mr-4">
                                        <label for="subContractor">Sub Contractor</label>
                                        <select name="subbie_id" id="subbie_id" class="form-control">
                                            <option selected disabled>Select Sub Contractor</option>
                                            @if (!empty($subbies))
                                                @foreach ($subbies as $subby)
                                                    <option value="{{ $subby->id }}">{{ $subby->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full pt-4">
                                    <label for="">Client Number</label>
                                    <input type="text" name="client_number" id="client_number"
                                        value="{{ $booking->client->client_number ?? '' }}" class="form-control w-full" readonly>
                                </div>
                                <div class="flex pt-4">
                                    <div class="flex flex-col w-1/2 mr-4">
                                        <label for="">Project Delivery Date</label>
                                        <input type="date" name="job_date" value="{{ $booking->job_date }}"
                                            class="form-control">
                                    </div>
                                    <div class="flex flex-col w-1/2">
                                        <label for="dateBooked">Date Booked</label>
                                        <input type="date" name="date_booked" value="{{ $booking->date_booked }}"
                                            id="Date-Booked" class="form-control">
                                    </div>
                                </div>

                                <div class="pt-4 mt-5">
                                    <h3 class="text-xl text-primary">Client Contact Details</h3>
                                    <div class="mt-4" style="display:none">
                                        <label for="">Contact ID</label>
                                        <input type="text" name="contact_id" id="contact_id"
                                            class="form-control w-full" readonly>
                                    </div>

                                    <div class="pt-4" id="client_details">
                                        <div>
                                            <label for="ContactName">Contact Contact Name</label>
                                            <select name="contact_name" id="contact_name" class="form-control w-100">
                                            </select>
                                        </div>

                                        <div class="mt-4">
                                            <label for="ContactNumber">Contact Number</label>
                                            <input type="text" name="contact_phone" id="contact_phone"
                                                class="form-control w-full" readonly>
                                        </div>

                                        <div class="mt-4">
                                            <label for="">Contact Email</label>
                                            <input type="text" name="contact_email" id="contact_email"
                                                class="form-control w-full" readonly>
                                        </div>

                                        <div class="pt-4">
                                            <label for="clientAddress">Client Address</label></br>
                                            <textarea name="client_address" id="client_address" cols="20" rows="5" class="form-control" readonly>{{ $booking->client->address ?? '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="pt-4" id="booking_client_details">
                                        <div class="mt-4">
                                            <label for="client-none-contact-name">Client Contact Name</label>
                                            <input type="text" name="client_none_contact_name" id="client_none_contact_name"
                                                class="form-control w-full">
                                        </div>                                    
                                        <div class="mt-4">
                                            <label for="booking-client-contact-no">Contact Number</label>
                                            <input type="text" name="client_none_contact_no" id="client_none_contact_no"
                                                class="form-control w-full">
                                        </div>
                                        <div class="mt-4">
                                            <label for="client-none-contact-email">Contact Email</label>
                                            <input type="text" name="client_none_contact_email" id="client_none_contact_email"
                                                class="form-control w-full">
                                        </div>
                                        <div class="pt-4">
                                            <label for="client-none-contact-address">Client Address</label></br>
                                            <textarea name="client_none_contact_address" id="client_none_contact_address" cols="20" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="pt-4 w-full">
                                    <h3 class="text-xl text-primary">Booking Status</h3>
                                    <div class="w-full pt-4">
                                        <label for="">Choose Booking Status</label>
                                        <?php
                                        $bookingStatus = ['Confirmed', 'Allocated', 'Shadow Booking', 'Canceled', 'Unallocated','Complete','Jobs To Check'];
                                        $selected = $booking->booking_status;
                                        ?>
                                        <select name="booking_status" id="booking_status" class="form-control"
                                            required="required">
                                            @foreach ($bookingStatus as $status)
                                                <option value="{{ $status }}"
                                                    {{ $selected == $status ? 'Selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <h3 class="pt-4 text-xl text-primary"> Project details </h3>
                                <div class="flex flex-col pt-4">
                                    <select name="project_id" id="project_id" class="form-control w-100">
                                        <option selected value=0>NONE</option>
                                        @foreach ($projects as $project)
                                            <option @selected($project->id == $booking->project_id) value="{{ $project->id }}">{{ $project->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full pt-4">
                                    <label for="">Project Order Number</label>
                                    <input type="text" name="project_order_number" value="{{ $booking->project->project_order_number ?? '' }}" id="project_order_number"
                                        class="form-control w-full" readonly>
                                </div>
                                <div class="w-full pt-4" style="display:none">
                                    <label for="">Project Order Number (On Transactions)</label>
                                    <input type="text" name="project_order_number_transaction" id="project_order_number_transaction"
                                        class="form-control w-full" readonly>
                                </div>
                                <div class="pt-4 mt-5">
                                    <h3 class="text-xl text-primary">Project Contact Details</h3>
                                    <div class="mt-4" style="display:none">
                                        <label for="">Contact ID</label>
                                        <input type="text" name="project_contact_id" id="project_contact_id"
                                            class="form-control w-full" readonly>
                                    </div>
                                    
                                    <div class="pt-4" id="project_contact_details">
                                        <div div class="mt-4">
                                            <label for="ProjectContactName">Project Contact Name</label>
                                            <select name="project_contact_name" id="project_contact_name" class="form-control w-100">
                                            </select>
                                        </div>

                                        <div class="mt-4">
                                            <label for="ProjectContactNumber">Contact Number</label>
                                            <input type="text" name="project_contact_phone" id="project_contact_phone" 
                                                class="form-control w-full" readonly>
                                        </div>
                                        <div class="mt-4">
                                            <label for="">Contact Email</label>
                                            <input type="text" name="project_contact_email" id="project_contact_email"
                                                class="form-control w-full" readonly>
                                        </div>

                                        <div class="mt-4">
                                            <label for="">Project Address</label>
                                            <div id="project_address_preview">
                                                <select name="project_address_id" id="project_address_id" class="form-control">
                                                    <option disabled selected>Select Job Address</option>
                                                    {{-- @if (!empty($projects))
                                                        @foreach ($projects as $project)
                                                            @if (!empty($project->addresses))
                                                                @foreach ($project->addresses as $address)
                                                                    <option value="{{ $address->id }}">
                                                                        {{ $address->address }}, {{ $address->suburb }},
                                                                        {{ $address->state }}, {{ $address->postcode }} </option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-4" id="project_none_contact_details">
                                        <div class="mt-4">
                                            <label for="project-none-contact-name">Project Contact Name</label>
                                            <input type="text" name="project_none_contact_name" id="project_none_contact_name" 
                                                class="form-control w-full">
                                        </div>                                    
                                        <div class="mt-4">
                                            <label for="project-none-contact-no">Contact Number</label>
                                            <input type="text" name="project_none_contact_no" id="project_none_contact_no" 
                                                class="form-control w-full">
                                        </div>
                                        <div class="mt-4">
                                            <label for="project-none-contact-email">Contact Email</label>
                                            <input type="text" name="project_none_contact_email" id="project_none_contact_email" 
                                                class="form-control w-full">
                                        </div>
                                        <div class="pt-4">
                                            <label for="project-none-contact-address">Project Address</label></br>
                                            <textarea name="project_none_contact_address" id="project_none_contact_address" cols="20" rows="5" class="form-control">
                                        </textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="pt-4 mt-5">
                                    <h3 class="text-xl text-primary">Concrete</h3>
                                    <div class="flex">
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                            <label for="">Start Time</label>
                                            <input type="time" name="job_start_time"
                                                value="{{ $booking->job_start_time }}" class="form-control"
                                                required="required">
                                        </div>
                                        <div class="flex flex-col pt-4 w-1/2">
                                            <label for="">Concrete Time</label>
                                            <input type="time" name="concrete_time" value="{{ $booking->concrete_time }}"
                                                class="form-control" required="required">

                                            @if ($errors->has('concrete_time'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('concrete_time') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="flex flex-col pt-4 mr-4 w-1/2">
                                        <label for="">Meters to Pump</label>
                                        <input type="text" name="metres_to_pump"
                                            value="{{ $booking->metres_to_pump }}" class="form-control">
                                    </div>
                                    <div class="flex flex-col pt-4 w-1/2">
                                        <label for="">Concrete Mix</label>
                                        <input type="text" name="concrete_mix" value="{{ $booking->concrete_mix }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="pt-4 w-full">
                                    <h3 class="text-xl text-primary">Notes</h3>
                                    <div class="pt-4">
                                        <label for="">Project Notes</label>
                                        <textarea name="job_notes" id="job-notes" cols="30" rows="10" class="form-control w-full h-20" readonly>{{ $booking->project->project_notes ?? '' }}</textarea>
                                    </div>
                                    <div class="pt-4">
                                        <label for="">Booking Notes</label>
                                        <textarea name="booking_notes" id="booking_notes" cols="30" rows="10" class="form-control w-full h-20">{{ $booking->booking_notes ?? '' }}</textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="border-l-2 border-slate-300 pl-4 w-1/2">
                                <div>
                                    <h2 class="text-xl text-primary pt-4">Workers</h2>
                                    <fieldset class="flex pt-4 w-full">
                                        <div class="flex flex-col mr-4 w-1/4">
                                            <label for="">Operator</label>
                                            <select name="worker_operator_id" id="worker_operator_id" class="form-control operator-select">
                                                <option selected value="">SELECT</option>
                                                @foreach ($operators as $operator)
                                                    <option value="{{ $operator->id }}">
                                                        {{ $operator->first_name }} {{ $operator->last_name }}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                        <div class="flex flex-col mr-4 w-1/4">
                                            <label for="lineHandSelect">Hoseman</label>
                                            <select name="worker_hoseman_id" id="worker_hoseman_id"
                                                class="form-control hoseman-select">
                                                <option selected value="">SELECT</option>
                                                @foreach ($hosemens as $hoseman)
                                                    <option value="{{ $hoseman->id }}">
                                                        {{ $hoseman->first_name }} {{ $hoseman->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="flex flex-col w-1/4 mr-4">
                                            <label for="">Extra Man</label>
                                            <select name="worker_extraman1_id" id="worker_extraman1_id"
                                                class="form-control extra-man-select">
                                                <option selected value="">SELECT</option>
                                                @foreach ($extramen as $extraman)
                                                    <option value="{{ $extraman->id }}">
                                                        {{ $extraman->first_name }} {{ $extraman->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="flex flex-col w-1/4 mr-4">
                                            <label for="ExtraManSelect">Extra Man</label>
                                            <select name="worker_extraman2_id" id="worker_extraman2_id"
                                                class="form-control extra-man-select">
                                                <option selected value="">SELECT</option>
                                                @foreach ($extramen as $extraman)
                                                    <option value="{{ $extraman->id }}">
                                                        {{ $extraman->first_name }} {{ $extraman->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="flex flex-col w-1/4">
                                            <label for="ExtraManSelect">Extra Man</label>
                                            <select name="worker_extraman3_id" id="worker_extraman3_id"
                                                class="form-control extra-man-select">
                                                <option selected value="">SELECT</option>
                                                @foreach ($extramen as $extraman)
                                                    <option value="{{ $extraman->id }}">
                                                        {{ $extraman->first_name }} {{ $extraman->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </fieldset>

                                </div>
                                <fieldset>
                                    <h2 class="text-xl text-primary mt-5">Pricing</h2>
                                    <div class="flex w-full">
                                        <div class="flex flex-col w-1/2 mr-4">
                                            <label for="">Concrete Supplier</label>
                                            <select name="concrete_supplier_id" class="form-control">
                                                <option value="" disabled>Select Concrete Type</option>
                                                @if (!empty($concreteSuppliers))
                                                    @foreach ($concreteSuppliers as $concreteSupplier)
                                                        @if ($concreteSupplier->id == $booking->concrete_supplier_id)
                                                            <option value="{{ $concreteSupplier->id }}"
                                                                selected="selected">
                                                                {{ $concreteSupplier->concrete_supplier }}</option>
                                                        @else
                                                            <option value="{{ $concreteSupplier->id }}">
                                                                {{ $concreteSupplier->concrete_supplier }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>
                                        <div class="flex flex-col w-1/2 ">
                                            <label for="">Job Type</label>
                                            <select name="concrete_type_id" class="form-control">
                                                <option value="" disabled>Select Concrete Type</option>
                                                @if (!empty($concreteTypes))
                                                    @foreach ($concreteTypes as $concreteType)
                                                        @if ($concreteType->id == $booking->concrete_type_id)
                                                            <option value="{{ $concreteType->id }}" selected="selected">
                                                                {{ $concreteType->concrete_type }}</option>
                                                        @else
                                                            <option value="{{ $concreteType->id }}">
                                                                {{ $concreteType->concrete_type }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex w-full">
                                        <div class="flex flex-col w-1/2 pt-4 mr-4">
                                            <label for="pricingCat"> Price Group</label>
                                            <select name="price_group_id" id="price_group_id" class="form-control">
                                                <!-- <option value="">Select Price Group</option> -->
                                                @if (!empty($priceGroups))
                                                    @php
                                                        $sortedPriceGroups = $priceGroups->sortBy('location_name');
                                                    @endphp
                                                    @foreach ($sortedPriceGroups as $priceGroup)
                                                        @if ($priceGroup->id == $booking->price_group_id)
                                                            <option value="{{ $priceGroup->id }}" selected="selected">
                                                                {{ $priceGroup->location_name }}</option>
                                                        @else
                                                            <option value="{{ $priceGroup->id }}">
                                                                {{ $priceGroup->location_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="flex flex-col w-1/2 pt-4 mr-4">
                                            <label for="PumpCat">Pump Category</label>
                                            <select name="pump_category_id" id="pump_category_id" class="form-control">
                                                <!-- <option selected disabled>Select Pump Category</option> -->

                                                @if (!empty($pumpCategories))
                                                    @php
                                                        $sortedPumpCategories = $pumpCategories->sortBy('category_name');
                                                    @endphp
                                                    @foreach ($sortedPumpCategories as $pumpCategory)
                                                        @if ($pumpCategory->id == $booking->pump_category_id)
                                                            <option value="{{ $pumpCategory->id }}" selected="selected">
                                                                {{ $pumpCategory->category_name }}</option>
                                                        @else
                                                            <option value="{{ $pumpCategory->id }}">
                                                                {{ $pumpCategory->category_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                        <div class="flex flex-col w-1/2 pt-4 mr-4">
                                            <label for="pump_size">Pump Size</label>
                                            <select name="pump_size" id="pump_size" class="form-control">
                                                <!-- <option value="">Select Pump Size</option> -->
                                            </select>
                                            <input type="hidden" name="pump_price_id" class="pump_price_id"
                                                id="pump_price_id" />
                                        </div>
                                    </div>
                                    <div class="flex w-full">
                                        <div class="flex flex-col w-full pt-4 mr-4">
                                            <label for="">Pump</label>
                                            <select name="pump_id" id="pump_id" class="form-control w-100">
                                                <option selected disabled>--Select Pump--</option>
                                                @if (!empty($pumps))
                                                    @foreach ($pumps as $pump)
                                                        <option value="{{ $pump->id }}">
                                                            {{ $pump->pump_name . ' - ' . $pump->plant_number . ' - ' . $pump->registration }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex w-full">
                                        <div class="flex flex-col w-full pt-4 mr-4">
                                            <label for="">Actual Pump Sent</label>
                                            <input type="text" name="actual_pump_sent" value="{{ $booking->actual_pump_sent }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="flex w-full">
                                        <div class="flex flex-col w-full pt-4 mr-4">
                                            <label for="">Pump Docket Number</label>
                                            <input type="text" name="pump_docket_number_origin" id="pump_docket_number_origin"
                                                class="form-control w-full" readonly>
                                        </div>
                                    </div>

                                    <div class="flex w-full">
                                        <div class="flex flex-col w-1/2 pt-4 mr-4">
                                            <label for="">Docket</label>
                                            <div class="flex">
                                                <div class="pt-4 mr-4">
                                                    <input type="text" name="docket_no" id="docket_no" value="{{ $booking->docket_no }}" 
                                                    class="form-control" readonly>
                                                </div>
                                                <div class="pt-4">
                                                    <input id="override_docket_no" name="override_docket_no" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Docket No"
                                                        type="checkbox"/>
                                                    <label for="override-docket-no">Docket Override</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="price-preview" id="price_preview">
                                    <fieldset class="w-full mr-6">
                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Time Onsite </label>
                                                <input type="time" name="time_onsite" id="time_onsite" value="{{ $booking->time_onsite }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Time Offsite</label>
                                                <input type="time" name="time_offsite" id="time_offsite" value="{{ $booking->time_offsite }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Total Hours</label>
                                                <input type="text" name="total_hours" id="total_hours" value="{{ $booking->total_hours }}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        </br></br>
                                        <div class="flex" style="font-weight: bold;">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Description</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Qty</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Rate</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Total</label>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Min Hire</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="min_hire" id="min_hire" value="{{ $booking->min_hire }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="min_hire_rate" id="min_hire_rate" value="{{ $booking->min_hire_rate }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4">
                                                <input id="override_min_hire" name="override_min_hire" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Rate"
                                                type="checkbox"/>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="min_hire_total" id="min_hire_total" value="{{ $booking->min_hire_total }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Extra Time (m)</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="extra_time" id="extra_time" value="{{ $booking->extra_time }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="extra_time_rate" id="extra_time_rate" value="{{ $booking->extra_time_rate }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4">
                                                <input id="override_extra_time" name="override_extra_time" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Rate"
                                                type="checkbox"/>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="extra_time_total" id="extra_time_total" value="{{ $booking->extra_time_total }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Metres Pumped</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="metres_pumped" id="metres_pumped" value="{{ $booking->metres_pumped }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="metres_pumped_rate" id="metres_pumped_rate" value="{{ $booking->metres_pumped_rate }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4">
                                                <input id="override_metres_pumped" name="override_metres_pumped" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Rate"
                                                type="checkbox"/>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="metres_pumped_total" id="metres_pumped_total" value="{{ $booking->metres_pumped_total }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Additional Man Per Hrs</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="additional_man_per_hr" id="additional_man_per_hr" value="{{ $booking->additional_man_per_hr }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="additional_man_per_hr_rate" id="additional_man_per_hr_rate" value="{{ $booking->additional_man_per_hr_rate }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4">
                                                <input id="override_additional_man_per_hr" name="override_additional_man_per_hr" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Rate"
                                                type="checkbox"/>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="additional_man_per_hr_total" id="additional_man_per_hr_total" value="{{ $booking->additional_man_per_hr_total }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Overtime Per Hrs</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="overtime_per_hr" id="overtime_per_hr" value="{{ $booking->overtime_per_hr }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="overtime_per_hr_rate" id="overtime_per_hr_rate" value="{{ $booking->overtime_per_hr_rate }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4">
                                                <input id="override_overtime_per_hr" name="override_overtime_per_hr" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Rate"
                                                type="checkbox"/>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="overtime_per_hr_total" id="overtime_per_hr_total" value="{{ $booking->overtime_per_hr_total }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Travel (kms)</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="travel" id="travel" value="{{ $booking->travel }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="travel_rate" id="travel_rate" value="{{ $booking->travel_rate }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4">
                                                <input id="override_travel" name="override_travel" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Rate"
                                                type="checkbox"/>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="travel_total" id="travel_total" value="{{ $booking->travel_total }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Washout Bag</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="washout_bag" id="washout_bag" value="{{ $booking->washout_bag }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="washout_bag_rate" id="washout_bag_rate" value="{{ $booking->washout_bag_rate }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4">
                                                <input id="override_washout_bag" name="override_washout_bag" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Rate"
                                                type="checkbox"/>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="washout_bag_total" id="washout_bag_total" value="{{ $booking->washout_bag_total }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Cement Bag</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="cement_bag" id="cement_bag" value="{{ $booking->cement_bag }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="cement_bag_rate" id="cement_bag_rate" value="{{ $booking->cement_bag_rate }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4">
                                                <input id="override_cement_bag" name="override_cement_bag" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Rate"
                                                type="checkbox"/>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="cement_bag_total" id="cement_bag_total" value="{{ $booking->cement_bag_total }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Offsite Cleanout</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="offsite_clean_out" id="offsite_clean_out" value="{{ $booking->offsite_clean_out }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="offsite_clean_out_rate" id="offsite_clean_out_rate" value="{{ $booking->offsite_clean_out_rate }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4">
                                                <input id="override_offsite_clean_out" name="override_offsite_clean_out" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Rate"
                                                type="checkbox"/>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="offsite_clean_out_total" id="offsite_clean_out_total" value="{{ $booking->offsite_clean_out_total }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <label for="">Pipeline Ext</label>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="pipeline_extension" id="pipeline_extension" value="{{ $booking->pipeline_extension }}" class="form-control">
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="pipeline_extension_rate" id="pipeline_extension_rate" value="{{ $booking->pipeline_extension_rate }}" class="form-control" readonly>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4">
                                                <input id="override_pipeline_extension" name="override_pipeline_extension" class="form-check-input" data-toggle="tooltip" data-placement="top" title="Override Rate"
                                                type="checkbox"/>
                                            </div>
                                            <div class="flex flex-col pt-4 mr-4 w-1/2">
                                                <input type="text" name="pipeline_extension_total" id="pipeline_extension_total" value="{{ $booking->pipeline_extension_total }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                    </fieldset>

                                    <input type="hidden" name="allSundries" id="allSundries" class="form-control">
                                    <div class="intro-y overflow-auto lg:overflow-visible">
                                        <div class="flex">
                                            <div class="flex flex-col pt-4">
                                                <a class="items-center mr-3 btn btn-pending btn-sm btn-duplicate" href="javascript:;" data-tw-toggle="modal" 
                                                data-tw-target="#sundries-modal">Add Sundries</a>
                                            </div>
                                        </div>
                                            <table id="sundriesTable" class="table table-striped table-bordered table-responsive 2xl:mt-2">
                                                <thead>
                                                    <tr>
                                                        <th>Sundries</th>
                                                        <th>Qty</th>
                                                        <th>Rates</th>
                                                        <th>Total</th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                    </div>
                                    </br>

                                    <div class="flex">
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                            <label for="" class="font-bold">Ex GST</label>
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                            <input type="text" name="ex_gst" id="ex_gst" value="{{ $booking->ex_gst }}" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                            <label for="" class="font-bold">GST</label>
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                            <input type="text" name="gst" id="gst" value="{{ $booking->gst }}" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                            <label for="" class="font-bold">Total</label>
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                            <input type="text" name="grand_total" id="grand_total" value="{{ $booking->grand_total }}" class="form-control" readonly>
                                        </div>
                                    </div>

                                </div>
                </div>
            </div>
            <!-- END: Uplaod Product -->

            <div class="w-full pt-4" style="display:none">
                <input type="text" name="prev_route" id="prev_route" value="{{ $prev_route }}"
                    class="form-control w-full" readonly>
            </div>

            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                <a href="{{ route('bookings.index') }}"
                    class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Update Booking</button>
            </div>
            </form>
        </div>
    </div>

    <div id="bad_credit_modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">This client have bad credit.</div>
                        <div class="text-slate-500 mt-2">
                            Do you wish to proceed?
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button href="{{ route('bookings.index') }}" id="cancelButton" data-tw-dismiss="modal"
                            class="btn btn-danger w-24 mr-1 btn-cancel">Cancel</button>
                        <button type="submit" id="confirmButton" class="btn btn-primary btn-credit-submit w-36"
                            close-modal data-tw-dismiss="modal">Yes, Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="sundries-modal" class="modal modal-lg" tabindex="-1" aria-hidden="true" style="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0 w-full">
                    <div class="pt-5 pl-5">
                        <h2 id="modal_sundries_title" class="text-xl text-center text-primary pb-4">New Sundries</h2>
                        <div id="messageAlert" class="alert alert-dismissible flex items-center mb-2 mr-4"
                            role="alert">
                            <span></span>
                            <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i
                                    data-lucide="x" class="w-4 h-4"></i></button>
                        </div>
                    </div>
                    <!-- <input type="hidden" name="sundries_id" id="sundries_id"> -->
                    <fieldset class=" p-5">
                        <div class="flex flex-col mb-5">
                            <label for="">Name</label>
                            <input type="text" name="sundries" class="form-control"
                                id="sundries">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="">Qty</label>
                            <input type="text" name="sundries_qty" class="form-control"
                                id="sundries_qty">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="">Rate</label>
                            <input type="text" name="sundries_rate" id="sundries_rate" class="form-control">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="">Total</label>
                            <input type="text" name="sundries_total" id="sundries_total" class="form-control" readonly>
                        </div>
                        <div class="pt-4 mt-5">
                            <button type="button" data-tw-dismiss="modal"
                                class="btn  border-slate-300 text-slate w-24 mr-1" onclick="clearModal();">Close</button>
                            <button type="button"
                                class="btn bg-primary text-white w-24 mr-1" data-tw-dismiss="modal" onclick="trapSundries();">Save</button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">

        var clientsContacts = [];
        var projectContacts = [];


        var allSundries = [];
        var sundries_status = 'add'
        var sundries_index = ''

        var projects = {!! $projects->toJson() !!};
        // var projects = [];
        var concreteTypes = {!! $concreteTypes->toJson() !!};
        var pumps = {!! $pumps->toJson() !!};
        var booking = {!! $booking->toJson() !!};
        var subbies = {!! $subbies->toJson() !!};

        var operators = {!! $operators->toJson() !!};
        var hosemens = {!! $hosemens->toJson() !!};
        var extramen = {!! $extramen->toJson() !!};

        $(document).ready(function(){
            getClientDetails();
            getProjectDetails();
            getPriceGroupSizes();
            getPriceGroup();
            setContact();
            setProjectContact();
            setPump();
            setSubbie();
            setPumpSize();
            setworkerOperator();
            setworkerHoseman();
            setworkerExtraman();
            setPriceRates();
            setSundries();
            setClientNoneContact();
            setProjectNoneContact();
            
        });


        //-------------------------------------------------------------------------On Change
        $(document).on('change', '#contact_name', getContact);
        $(document).on('change', '#project_contact_name', getProjectContact);

        jQuery("#project_id").on("change", function() {
            getProjectDetails();
            getProjectLatestOrderNumber();
        });

        jQuery("#client_id").on("change", function() {
            getClientDetails();
            getClientProjects();
            getProjectDetails();
            getProjectLatestOrderNumber();
        });

        jQuery("#pump_id").on("change", function() {
            getPumpLatestOrderNumber();
        });

        jQuery('#price_group_id').on('change', function() {
            getPriceGroup();
            getPriceGroupSizes();
            getPriceGroupSizesDetails();
            computeTotals();
        });

        jQuery("#pump_category_id").on("change", function() {
            getPriceGroupSizes();
            getPriceGroupSizesDetails()
            computeTotals();
        });

        jQuery("#pump_size").on("change", function() {
            getPriceGroupSizesDetails();
            computeTotals();
        });

        jQuery("#worker_operator_id").on("change", function() {
            disableSelectedWorker();
        });

        jQuery("#worker_hoseman_id").on("change", function() {
            disableSelectedWorker();
        });

        jQuery("#worker_extraman1_id").on("change", function() {
            disableSelectedWorker();
        });

        jQuery("#worker_extraman2_id").on("change", function() {
            disableSelectedWorker();
        });

        jQuery("#worker_extraman3_id").on("change", function() {
            disableSelectedWorker();
        });

        jQuery("#sundries_qty").on("focusout", function() {
            $("#sundries_total").val("")

            $("#sundries_qty").val(helper.onlyNumber($("#sundries_qty").val()));
            
            if($("#sundries_qty").val() && $("#sundries_rate").val()){
                $("#sundries_total").val($("#sundries_qty").val() * $("#sundries_rate").val());
            }
        });

        jQuery("#sundries_rate").on("focusout", function() {
            $("#sundries_total").val("")
            
            $("#sundries_rate").val(helper.onlyNumber($("#sundries_rate").val()));
            
            if($("#sundries_qty").val() && $("#sundries_rate").val()){
                $("#sundries_total").val($("#sundries_qty").val() * $("#sundries_rate").val());
            }
        });

        //------- OVERRIDE RATES
        $("#override_min_hire").change(function(event){
            if (this.checked){
                $("#min_hire_rate").removeAttr("readonly"); 
            } else {
                $("#min_hire_rate").attr("readonly", "readonly");
            }
        });

        $("#override_extra_time").change(function(event){
            if (this.checked){
                $("#extra_time_rate").removeAttr("readonly"); 
            } else {
                $("#extra_time_rate").attr("readonly", "readonly");
            }
        });

        $("#override_metres_pumped").change(function(event){
            if (this.checked){
                $("#metres_pumped_rate").removeAttr("readonly"); 
            } else {
                $("#metres_pumped_rate").attr("readonly", "readonly");
            }
        });

        $("#override_additional_man_per_hr").change(function(event){
            if (this.checked){
                $("#additional_man_per_hr_rate").removeAttr("readonly"); 
            } else {
                $("#additional_man_per_hr_rate").attr("readonly", "readonly");
            }
        });

        $("#override_overtime_per_hr").change(function(event){
            if (this.checked){
                $("#overtime_per_hr_rate").removeAttr("readonly"); 
            } else {
                $("#overtime_per_hr_rate").attr("readonly", "readonly");
            }
        });

        $("#override_travel").change(function(event){
            if (this.checked){
                $("#travel_rate").removeAttr("readonly"); 
            } else {
                $("#travel_rate").attr("readonly", "readonly");
            }
        });

        $("#override_washout_bag").change(function(event){
            if (this.checked){
                $("#washout_bag_rate").removeAttr("readonly"); 
            } else {
                $("#washout_bag_rate").attr("readonly", "readonly");
            }
        });

        $("#override_cement_bag").change(function(event){
            if (this.checked){
                $("#cement_bag_rate").removeAttr("readonly"); 
            } else {
                $("#cement_bag_rate").attr("readonly", "readonly");
            }
        });

        $("#override_offsite_clean_out").change(function(event){
            if (this.checked){
                $("#offsite_clean_out_rate").removeAttr("readonly"); 
            } else {
                $("#offsite_clean_out_rate").attr("readonly", "readonly");
            }
        });

        $("#override_pipeline_extension").change(function(event){
            if (this.checked){
                $("#pipeline_extension_rate").removeAttr("readonly"); 
            } else {
                $("#pipeline_extension_rate").attr("readonly", "readonly");
            }
        });

        //------- OVERRIDE DOCKET NO

        $("#override_docket_no").change(function(event){
            if (this.checked){
                $("#docket_no").removeAttr("readonly"); 
            } else {
                $("#docket_no").attr("readonly", "readonly");
            }
        });


        //-------------------------------------------------------------------------On Focus Out

        jQuery("#time_onsite").on("focusout", function() {
            var start = $("#time_onsite").val();
            var end = $("#time_offsite").val();

            if($("#time_onsite").val() && $("#time_offsite").val()){
                var hours = helper.timeDiff(start, end);
                $("#total_hours").val(hours);

                formula = hours - 2
                
                if (formula < 0){
                    $("#extra_time").val(0)
                }else{
                    $("#extra_time").val(formula)
                }
                
                computeTotals();
            }
        });

        jQuery("#time_offsite").on("focusout", function() {
            var start = $("#time_onsite").val();
            var end = $("#time_offsite").val();

            if($("#time_onsite").val() && $("#time_offsite").val()){
                var hours = helper.timeDiff(start, end);
                $("#total_hours").val(hours);

                formula = hours - 2
                
                if (formula < 0){
                    $("#extra_time").val(0)
                }else{
                    $("#extra_time").val(formula)
                }
                
                computeTotals();
            }
        });

        jQuery("#min_hire").on("focusout", function() {
            $("#min_hire").val(helper.onlyNumber($("#min_hire").val()));

            if ($("#min_hire").val() < 1){ // min hire should always 1
                $("#min_hire").val(1)
            }

            computeTotals();
        });

        jQuery("#min_hire_rate").on("focusout", function() {
            $("#min_hire_rate").val(helper.onlyNumber($("#min_hire_rate").val()));

            computeTotals();
        });

        jQuery("#extra_time_rate").on("focusout", function() {
            $("#extra_time_rate").val(helper.onlyNumber($("#extra_time_rate").val()));

            computeTotals();
        });

        jQuery("#metres_pumped").on("focusout", function() {
            $("#metres_pumped").val(helper.onlyNumber($("#metres_pumped").val()));

            computeTotals();
        });

        jQuery("#metres_pumped_rate").on("focusout", function() {
            $("#metres_pumped_rate").val(helper.onlyNumber($("#metres_pumped_rate").val()));

            computeTotals();
        });

        jQuery("#additional_man_per_hr").on("focusout", function() {   
            $("#additional_man_per_hr").val(helper.onlyNumber($("#additional_man_per_hr").val()));

            computeTotals();
        });

        jQuery("#additional_man_per_hr_rate").on("focusout", function() {   
            $("#additional_man_per_hr_rate").val(helper.onlyNumber($("#additional_man_per_hr_rate").val()));

            computeTotals();
        });

        jQuery("#overtime_per_hr").on("focusout", function() {
            $("#overtime_per_hr").val(helper.onlyNumber($("#overtime_per_hr").val()));

            computeTotals();
        });

        jQuery("#overtime_per_hr_rate").on("focusout", function() {
            $("#overtime_per_hr_rate").val(helper.onlyNumber($("#overtime_per_hr_rate").val()));

            computeTotals();
        });


        jQuery("#travel").on("focusout", function() {
            $("#travel").val(helper.onlyNumber($("#travel").val()));

            computeTotals();
        });

        jQuery("#travel_rate").on("focusout", function() {
            $("#travel_rate").val(helper.onlyNumber($("#travel_rate").val()));

            computeTotals();
        });

        jQuery("#washout_bag").on("focusout", function() {
            $("#washout_bag").val(helper.onlyNumber($("#washout_bag").val()));

            computeTotals();
        });

        jQuery("#washout_bag_rate").on("focusout", function() {
            $("#washout_bag_rate").val(helper.onlyNumber($("#washout_bag_rate").val()));

            computeTotals();
        });

        jQuery("#cement_bag").on("focusout", function() {
            $("#cement_bag").val(helper.onlyNumber($("#cement_bag").val()));

            computeTotals();
        });

        jQuery("#cement_bag_rate").on("focusout", function() {
            $("#cement_bag_rate").val(helper.onlyNumber($("#cement_bag_rate").val()));

            computeTotals();
        });

        jQuery("#offsite_clean_out").on("focusout", function() {
            $("#offsite_clean_out").val(helper.onlyNumber($("#offsite_clean_out").val()));

            computeTotals();
        });

        jQuery("#offsite_clean_out_rate").on("focusout", function() {
            $("#offsite_clean_out_rate").val(helper.onlyNumber($("#offsite_clean_out_rate").val()));

            computeTotals();
        });

        jQuery("#pipeline_extension").on("focusout", function() {
            $("#pipeline_extension").val(helper.onlyNumber($("#pipeline_extension").val()));

            computeTotals();
        });

        jQuery("#pipeline_extension_rate").on("focusout", function() {
            $("#pipeline_extension_rate").val(helper.onlyNumber($("#pipeline_extension_rate").val()));

            computeTotals();
        });


        //-------------------------------------------------------------------------Methods

        function trapSundries(){
            if ($("#sundries_total").val()){
                saveSundries()
            }
        }

        //Save Sundries
        function saveSundries() {
            if (sundries_status == 'add'){
                var sundries = {
                    id: null,
                    sundries: $("#sundries").val(),
                    sundries_qty: parseFloat($("#sundries_qty").val()),
                    sundries_rate: parseFloat($("#sundries_rate").val()),
                    sundries_total: parseFloat($("#sundries_total").val()),
                }

                allSundries.push(sundries)
                
            }else{

                allSundries[sundries_index].sundries = $("#sundries").val()
                allSundries[sundries_index].sundries_qty = $("#sundries_qty").val()
                allSundries[sundries_index].sundries_rate = $("#sundries_rate").val()
                allSundries[sundries_index].sundries_total =  $("#sundries_total").val()
                
            }

            displaySundries();
            clearModal()
        }

        function clearModal() {
            $("#sundries").val("")
            $("#sundries_qty").val("")
            $("#sundries_rate").val("")
            $("#sundries_total").val("")

            sundries_status = 'add'
            sundries_index  = ''
            $("#modal_sundries_title").text("New Sundries");
        } 

        //Edit Sundries
        $(document).on('click', '.edit-sundries', function(e){
                e.preventDefault();
                var currentRow = $(this).closest('tr');

                var index = parseInt(currentRow.data('id'))

                const el = document.querySelector("#sundries-modal");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();

                var record = allSundries.at(index)

                $("#sundries").val(record.sundries)
                $("#sundries_qty").val(record.sundries_qty)
                $("#sundries_rate").val(record.sundries_rate)
                $("#sundries_total").val(record.sundries_total)

                sundries_status = 'update'
                sundries_index = index

                $("#modal_sundries_title").text("Update Sundries");
        });

        //Delete Sundries
        $(document).on('click', '.delete-sundries', function(e){
                e.preventDefault();
                var currentRow = $(this).closest('tr');
                var index = parseInt(currentRow.data('id'))

                allSundries.splice(index,1)
                displaySundries()
        });

        function displaySundries() {

            jQuery("#sundriesTable tbody").empty();

            allSundries.forEach(function (item, index) {
                jQuery("#sundriesTable tbody").append("<tr data-id='"  + index + "'>" +
                    "<td>" + item.sundries + "</td>" +
                    "<td>" + parseFloat(item.sundries_qty).toFixed(2).toLocaleString() + "</td>" +
                    "<td>" + parseFloat(item.sundries_rate).toFixed(2).toLocaleString() + "</td>" +
                    "<td>" + parseFloat(item.sundries_total).toFixed(2).toLocaleString() + "</td>" +
                    "<td>" + "<div class='flex justify-center items-center'><a class='flex items-center mr-3 btn btn-warning btn-sm edit-sundries'>Edit</a><a class='flex items-center mr-3 btn btn-pending btn-sm btn-duplicate delete-sundries' href='javascript:;'>Delete</a></div>" + "</td>" +
                    "</tr>");
                })

            computeTotals();
            $("#allSundries").val(JSON.stringify(allSundries));

        }

        function computeTotals(){
            var sundries_total = 0

            allSundries.forEach(function (item) {
                sundries_total += parseFloat(item.sundries_total)
            })

            $("#min_hire_total").val($("#min_hire").val() * $("#min_hire_rate").val());
            $("#extra_time_total").val($("#extra_time").val() * $("#extra_time_rate").val());
            $("#metres_pumped_total").val($("#metres_pumped").val() * $("#metres_pumped_rate").val());
            $("#additional_man_per_hr_total").val($("#additional_man_per_hr").val() * $("#additional_man_per_hr_rate").val());
            $("#overtime_per_hr_total").val($("#overtime_per_hr").val() * $("#overtime_per_hr_rate").val());
            $("#travel_total").val($("#travel").val() * $("#travel_rate").val());
            $("#washout_bag_total").val($("#washout_bag").val() * $("#washout_bag_rate").val());
            $("#cement_bag_total").val($("#cement_bag").val() * $("#cement_bag_rate").val());
            $("#offsite_clean_out_total").val($("#offsite_clean_out").val() * $("#offsite_clean_out_rate").val());
            $("#pipeline_extension_total").val($("#pipeline_extension").val() * $("#pipeline_extension_rate").val());


            var exGST = parseFloat($("#min_hire_total").val()) + parseFloat($("#metres_pumped_total").val()) +
                        parseFloat($("#additional_man_per_hr_total").val()) + parseFloat($("#overtime_per_hr_total").val()) +
                        parseFloat($("#extra_time_total").val()) + parseFloat($("#travel_total").val()) +
                        parseFloat($("#washout_bag_total").val()) + parseFloat($("#cement_bag_total").val()) +
                        parseFloat($("#offsite_clean_out_total").val()) + parseFloat($("#pipeline_extension_total").val()) + parseFloat(sundries_total);

            $("#ex_gst").val(exGST);

            var GST = $("#ex_gst").val() / 10;

            $("#gst").val(GST);

            $("#grand_total").val(exGST + GST);
        }


        function getClientDetails(){
            let id = $('#client_id').val();
            let url = '{{ route('getDetails', ':id') }}';
            url = url.replace(':id', id);

            clientsContacts = [];

            if($('#client_id').val() == 0){
                jQuery("#booking_client_details").show();
                jQuery("#client_details").hide();
                jQuery('#client_number').val('')

                jQuery('#client_none_contact_name').val('')
                jQuery('#client_none_contact_no').val('')
                jQuery('#client_none_contact_email').val('')
                jQuery('#client_none_contact_address').val('')
            }    
            else{
                jQuery("#booking_client_details").hide();
                jQuery("#client_details").show();

                jQuery.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    async: false,
                    success: function(response) {
                        if (response != null) {
                            // Check if the client has bad credit
                            if (response.bad_credit) {
                                const el = document.querySelector("#bad_credit_modal");
                                const modal = tailwind.Modal.getOrCreateInstance(el);
                                modal.show();
                                return false;
                            } else {
                                $('#add-booking-div').removeAttr('style');
                            }
                            jQuery('#client_address').val(response.address).addClass('text-success').css(
                                'font-size', '16px');

                            jQuery('#client_number').val(response.client_number).addClass('text-success')
                                .css('font-size', '16px');

                            for (let i = 0; i < response.contacts.length; i++) {
                                if(response.contacts[i].contact_name != ""){
                                    clientsContacts.push(response.contacts[i])
                                }
                            }

                            jQuery("#contact_name").empty();
                            jQuery("#contact_phone").val('');
                            jQuery("#contact_email").val('');
                            jQuery("#contact_id").val('');

                            for (let i = 0; i < clientsContacts.length; i++) {
                                if (clientsContacts[i] != null) {
                                    jQuery("#contact_name").append($("<option />").val(clientsContacts[i].id).text(clientsContacts[i].contact_name));
                                }
                            }
                            
                            if(clientsContacts.length > 0) {
                                jQuery("#contact_phone").val(clientsContacts[0].contact_phone).addClass('text-success').css('font-size', '16px');
                                jQuery("#contact_email").val(clientsContacts[0].contact_email).addClass('text-success').css('font-size', '16px');
                                jQuery("#contact_id").val(clientsContacts[0].id).addClass('text-success').css('font-size', '16px');
                            }

                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus + ': ' + errorThrown);
                    }
                });
            }
        }

        function getClientProjects(){
            let id = $('#client_id').val();
            let url = '{{ route('getClientProjects', ':id') }}';
            url = url.replace(':id', id);

            jQuery.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    async: false,
                    success: function(response) {

                        projects = response.data

                        jQuery("#project_id").empty();
                        jQuery("#project_id").append($("<option />").val(0).text('NONE'));

                        for (var i = 0; i < response.data.length; i++) {
                            jQuery("#project_id").append($("<option />").val(response.data[i].id).text(response.data[i].project_name));
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus + ': ' + errorThrown);
                    }
                });
        }

        function createBookingNumber(){
                jQuery('#booking_number').val($("#project_order_number").val() + "-" + $("#project_order_number_transaction").val().toString()).addClass('text-success')
                .css('font-size', '16px');   
        }

        function getContact(){
            for (let i = 0; i < clientsContacts.length; i++) {
                if(clientsContacts[i].id == $('#contact_name').val()){
                    jQuery("#contact_phone").val(clientsContacts[i].contact_phone).addClass('text-success').css('font-size', '16px');
                    jQuery("#contact_email").val(clientsContacts[i].contact_email).addClass('text-success').css('font-size', '16px');
                    jQuery("#contact_id").val(clientsContacts[i].id).addClass('text-success').css('font-size', '16px');
                }
            }
        }

        function getProjectContact(){
            for (let i = 0; i < projectContacts.length; i++) {
                if(projectContacts[i].id == $('#project_contact_name').val()){
                    jQuery("#project_contact_phone").val(projectContacts[i].contact_phone).addClass('text-success').css('font-size', '16px');
                    jQuery("#project_contact_email").val(projectContacts[i].contact_email).addClass('text-success').css('font-size', '16px');
                    jQuery("#project_contact_id").val(projectContacts[i].id).addClass('text-success').css('font-size', '16px');
                }
            }
        }

        function setContact(){
            for (let i = 0; i < clientsContacts.length; i++) {
                if(clientsContacts[i].id == $('#contact_name').val()){
                    jQuery("#contact_name").val(clientsContacts[i].id);
                    jQuery("#contact_phone").val(clientsContacts[i].contact_phone).addClass('text-success').css('font-size', '16px');
                    jQuery("#contact_email").val(clientsContacts[i].contact_email).addClass('text-success').css('font-size', '16px');
                    jQuery("#contact_id").val(clientsContacts[i].id).addClass('text-success').css('font-size', '16px');
                }
            }
        }

        function setProjectContact(){
            for (let i = 0; i < projectContacts.length; i++) {
                if(projectContacts[i].id == $('#project_contact_name').val()){
                    jQuery("#project_contact_name").val(projectContacts[i].id);
                    jQuery("#project_contact_phone").val(projectContacts[i].contact_phone).addClass('text-success').css('font-size', '16px');
                    jQuery("#project_contact_email").val(projectContacts[i].contact_email).addClass('text-success').css('font-size', '16px');
                    jQuery("#project_contact_id").val(projectContacts[i].id).addClass('text-success').css('font-size', '16px');
                }
            }
        }

        function setPump(){
            var pumpId = {{ $booking->pump_id ?? 0 }};

            for (let i = 0; i < pumps.length; i++) {
                if(pumps[i].id == pumpId){
                    jQuery("#pump_id").val(pumps[i].id);
                    jQuery("#pump_docket_number_origin").val(pumps[i].pump_docket_number);
                }
            }
        }

        function setworkerOperator(){
            var operatorId = {{ $booking->worker_operator_id ?? 0 }};

            for (let i = 0; i < operators.length; i++) {
                if(operators[i].id == operatorId){
                    jQuery("#worker_operator_id").val(operators[i].id);
                    disableSelectedWorker();
                }
            }
        }

        function setworkerHoseman(){
            var hosemanId = {{ $booking->worker_hoseman_id ?? 0 }};

            for (let i = 0; i < hosemens.length; i++) {
                if(hosemens[i].id == hosemanId){
                    jQuery("#worker_hoseman_id").val(hosemens[i].id);
                    disableSelectedWorker();
                }
            }
        }

        function setworkerExtraman(){
            var extraman1Id = {{ $booking->worker_extraman1_id ?? 0 }};
            var extraman2Id = {{ $booking->worker_extraman2_id ?? 0 }};
            var extraman3Id = {{ $booking->worker_extraman3_id ?? 0 }};

            for (let i = 0; i < extramen.length; i++) {
                if(extramen[i].id == extraman1Id){
                    jQuery("#worker_extraman1_id").val(extramen[i].id);
                    disableSelectedWorker();
                }
            }

            for (let i = 0; i < extramen.length; i++) {
                if(extramen[i].id == extraman2Id){
                    jQuery("#worker_extraman2_id").val(extramen[i].id);
                    disableSelectedWorker();
                }
            }

            for (let i = 0; i < extramen.length; i++) {
                if(extramen[i].id == extraman3Id){
                    jQuery("#worker_extraman3_id").val(extramen[i].id);
                    disableSelectedWorker();
                }
            }
        }

        function setSubbie(){
            var subbieId = {{ $booking->subbie_id ?? 0 }};

            for (let i = 0; i < subbies.length; i++) {
                if(subbies[i].id == subbieId){
                    jQuery("#subbie_id").val(subbies[i].id);
                }
            }
        }

        function setPumpSize(){
            var pumpPriceId = {{ $booking->pump_price_id ?? 0 }};

            $('#pump_size').val(pumpPriceId);

            $('#pump_price_id').val(pumpPriceId);

            getPriceGroupSizesDetails();
            computeTotals();
        }

        function setPriceRates(){
            $('#min_hire_rate').val({{ $booking->min_hire_rate ?? '' }});
            $('#extra_time_rate').val({{ $booking->extra_time_rate ?? '' }});
            $('#metres_pumped_rate').val({{ $booking->metres_pumped_rate ?? '' }});
            $('#additional_man_per_hr_rate').val({{ $booking->additional_man_per_hr_rate ?? '' }});
            $('#overtime_per_hr_rate').val({{ $booking->overtime_per_hr_rate ?? '' }});
            $('#washout_bag_rate').val({{ $booking->washout_bag_rate ?? '' }});
            $('#cement_bag_rate').val({{ $booking->cement_bag_rate ?? '' }});
            $('#offsite_clean_out_rate').val({{ $booking->offsite_clean_out_rate ?? '' }});
            $('#pipeline_extension_rate').val({{ $booking->pipeline_extension_rate ?? '' }});

            computeTotals();
        }

        function setSundries(){
            if (booking.sundries.length > 0){
                allSundries = booking.sundries
            }

            displaySundries()
        }

        function setClientNoneContact(){
            $('#client_none_contact_name').val(booking.client_none_contact_name);
            $('#client_none_contact_no').val(booking.client_none_contact_no);
            $('#client_none_contact_email').val(booking.client_none_contact_email);
            $('#client_none_contact_address').val(booking.client_none_contact_address);
        }

        function setProjectNoneContact(){
            $('#project_none_contact_name').val(booking.project_none_contact_name);
            $('#project_none_contact_no').val(booking.project_none_contact_no);
            $('#project_none_contact_email').val(booking.project_none_contact_email);
            $('#project_none_contact_address').val(booking.project_none_contact_address);
        }


        // jQuery("#pump_category_id").trigger("change");

        function getProjectDetails(){
            let projectId = $('#project_id').val();
            var project = projects.find(function(project) {
                return project.id == projectId;
            });

            projectContacts = [];

            if($('#project_id').val() == 0){
                jQuery('#job_notes').val('').addClass('text-primary');
                jQuery('#project_order_number').val('0000').addClass('text-primary');
            }else{

                jQuery('#job_notes').val(project.project_notes).addClass('text-primary');
                jQuery('#project_order_number').val(project.project_order_number).addClass('text-primary');


                for (let i = 0; i < project.contacts.length; i++) {
                    if(project.contacts[i].contact_name !== undefined && 
                            project.contacts[i].contact_name !== null && 
                            project.contacts[i].contact_name.trim().length > 0){
                        projectContacts.push(project.contacts[i])
                    }
                }
            }

            jQuery("#project_contact_name").empty();
            jQuery("#project_contact_phone").val('');
            jQuery("#project_contact_email").val('');
            jQuery("#project_contact_id").val('');

            for (let i = 0; i < projectContacts.length; i++) {
                if (projectContacts[i] != null) {
                    jQuery("#project_contact_name").append($("<option />").val(projectContacts[i].id).text(projectContacts[i].contact_name));
                }
            }
            
            if(projectContacts.length > 0) {
                jQuery("#project_contact_phone").val(projectContacts[0].contact_phone).addClass('text-success').css('font-size', '16px');
                jQuery("#project_contact_email").val(projectContacts[0].contact_email).addClass('text-success').css('font-size', '16px');
                jQuery("#project_contact_id").val(projectContacts[0].id).addClass('text-success').css('font-size', '16px');
            }

            if (project) {

                jQuery("#project_contact_details").show();
                jQuery("#project_none_contact_details").hide();

                // Filter addresses
                jQuery("#project_address_id").empty();
                if (project.addresses.length > 0) {
                    project.addresses.forEach(function(address) {
                        jQuery("#project_address_id").append('<option value="' +
                            address.id + '">' + address.address + ', ' + address.suburb + ', ' +
                            address.state + ', ' + address.postcode + '</option>');
                    });
                } else {
                    jQuery("#project_address_id").append(
                        '<option disabled selected>No address for this project</option>');
                }
            } else {

                jQuery("#project_contact_details").hide();
                jQuery("#project_none_contact_details").show();
            }
        }

        function getProjectLatestOrderNumber(){

            let url = '{{ route('getProjectLatestOrderNumber') }}';

            var project_id = null

            if ($('#project_id').val() == 0){
                project_id = null
            }else{
                project_id = $('#project_id').val()
            }

            if (booking.project_id == project_id){
                jQuery('#booking_number').val(booking.booking_number).addClass('text-success')
                .css('font-size', '16px');  
            }else{
                jQuery.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    data: {
                        'project_id': project_id,
                    },
                    async: false,
                    success: function(response) {
                        if (response != null) {
                            
                            jQuery('#project_order_number_transaction').val(response.data.booking_number).addClass('text-primary');
                            createBookingNumber();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus + ': ' + errorThrown);
                    }
                });
            }
        }


        function getPumpLatestOrderNumber(){
            let id = $('#pump_id').val();
            let url = '{{ route('getPumpLatestOrderNumber', ':id') }}';
            url = url.replace(':id', id);

            jQuery.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(response) {
                    if (response != null) {
                        jQuery('#pump_docket_number').val(response.pump.pump_docket_number).addClass('text-primary');

                        jQuery('#pump_docket_number_origin').val(response.pump.pump_docket_number).addClass('text-primary');

                        jQuery('#docket_no').val(response.data.docket_no).addClass('text-primary');
                    
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + ': ' + errorThrown);
                }
            });
        }


        if(booking.is_subbie_required == 1){
            $('#is_subbie_required').prop('checked', true);
        }else{
            $('#is_subbie_required').prop('checked', false);
        }
        

        const is_subbie = document.querySelector('#is_subbie_required');
        const subbie_preview = document.querySelector('#subbie_preview');

        if ($('#is_subbie_required').is(':checked')) {
            subbie_preview.style.display = '';
            $('#is_subbie_required').val(1)
        }else{
            subbie_preview.style.display = 'none';
            $('#is_subbie_required').val(0)
        }

        is_subbie.addEventListener('change', function() {
            if ($('#is_subbie_required').is(':checked')) {
                subbie_preview.style.display = '';
                $('#is_subbie_required').val(1)
            }else{
                subbie_preview.style.display = 'none';
                $('#is_subbie_required').val(0)
            }
        });

        function getPriceGroup(){
            var priceGroupId = $('#price_group_id').val();
            jQuery.ajax({
                url: '/getPriceGroupDetails/' + priceGroupId,
                method: 'get',
                async: false,
                success: function(response) {
                    
                    $('#cement_bag_rate').val(response.cement_bag);
                    $('#washout_bag_rate').val(response.washout_bag_cost);
                    $('#pipeline_extension_rate').val(response.pipeline_extension);
                    $('#additional_man_per_hr_rate').val(response.additional_man_per_hour);
                    $('#overtime_per_hr_rate').val(response.overtime_per_hour_per_man);
                    $('#offsite_clean_out_rate').val(response.offsite_clean_out);
                    $('#travel_rate').val(response.travel);
                }
            });
        }

        function getPriceGroupSizes(){

            let url = '{{ route('getPumpPriceList') }}';

            jQuery.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                async: false,
                data: {
                    'price_group_id': $('#price_group_id').val(),
                    'pump_category_id': $('#pump_category_id').val()
                },
                success: function(response) {
                    if (response.pumpPrices) {
                        var pumpPrices = response.pumpPrices;

                        jQuery("#pump_size").empty();
                        for (var i = 0; i < pumpPrices.length; i++) {
                            if (pumpPrices[i].size) {
                                jQuery("#pump_size").append($("<option />").val(pumpPrices[i].id).text(pumpPrices[i].size));
                            } else {

                                $('#extra_time_rate').val(pumpPrices[i].extra_time_per_hour);
                                $('#min_hire_rate').val(pumpPrices[i].min_hire_first_2_hours_on_site);
                                $('#metres_pumped_rate').val(pumpPrices[i].per_cube_meter_of_concrete);
                                $('#pump_price_id').val(pumpPrices[i].id);
                                computeTotals();
                            }
                        }
                        if(pumpPrices.length > 1){
                            jQuery("#pump_size").trigger("change");
                        }
                    }

                }
            });
        }

        function getPriceGroupSizesDetails(){
            let id = $('#pump_size').val();

            let url = '{{ route('getPumpPrice', ':id') }}';
            url = url.replace(':id', id);

            jQuery.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(response) {

                    if (response.pumpPrice) {
                        
                        $('#min_hire_rate').val(response.pumpPrice.min_hire_first_2_hours_on_site);
                        $('#extra_time_rate').val(response.pumpPrice.extra_time_per_hour);
                        $('#metres_pumped_rate').val(response.pumpPrice.per_cube_meter_of_concrete);
                        $('#pump_price_id').val(response.pumpPrice.id);
                        computeTotals();
                    }
                }
            });
        }


        function disableSelectedWorker() {
            $('#worker_operator_id').children().removeAttr("disabled");
            $('#worker_hoseman_id').children().removeAttr("disabled");
            $('#worker_extraman1_id').children().removeAttr("disabled");
            $('#worker_extraman2_id').children().removeAttr("disabled");
            $('#worker_extraman3_id').children().removeAttr("disabled");

            var operatorID = $("#worker_operator_id").val();
            var hosemanID = $("#worker_hoseman_id").val();
            var extraman1ID = $("#worker_extraman1_id").val();
            var extraman2ID = $("#worker_extraman2_id").val();
            var extraman3ID = $("#worker_extraman3_id").val();

            $('#worker_hoseman_id').children('option[value="' + operatorID + '"]').attr('disabled', true);
            $('#worker_extraman1_id').children('option[value="' + operatorID + '"]').attr('disabled', true);
            $('#worker_extraman2_id').children('option[value="' + operatorID + '"]').attr('disabled', true);
            $('#worker_extraman3_id').children('option[value="' + operatorID + '"]').attr('disabled', true);

            $('#worker_operator_id').children('option[value="' + hosemanID + '"]').attr('disabled', true);
            $('#worker_extraman1_id').children('option[value="' + hosemanID + '"]').attr('disabled', true);
            $('#worker_extraman2_id').children('option[value="' + hosemanID + '"]').attr('disabled', true);
            $('#worker_extraman3_id').children('option[value="' + hosemanID + '"]').attr('disabled', true);

            $('#worker_operator_id').children('option[value="' + extraman1ID + '"]').attr('disabled', true);
            $('#worker_hoseman_id').children('option[value="' + extraman1ID + '"]').attr('disabled', true);
            $('#worker_extraman2_id').children('option[value="' + extraman1ID + '"]').attr('disabled', true);
            $('#worker_extraman3_id').children('option[value="' + extraman1ID + '"]').attr('disabled', true);

            $('#worker_operator_id').children('option[value="' + extraman2ID + '"]').attr('disabled', true);
            $('#worker_hoseman_id').children('option[value="' + extraman2ID + '"]').attr('disabled', true);
            $('#worker_extraman1_id').children('option[value="' + extraman2ID + '"]').attr('disabled', true);
            $('#worker_extraman3_id').children('option[value="' + extraman2ID + '"]').attr('disabled', true);

            $('#worker_operator_id').children('option[value="' + extraman3ID + '"]').attr('disabled', true);
            $('#worker_hoseman_id').children('option[value="' + extraman3ID + '"]').attr('disabled', true);
            $('#worker_extraman1_id').children('option[value="' + extraman3ID + '"]').attr('disabled', true);
            $('#worker_extraman2_id').children('option[value="' + extraman3ID + '"]').attr('disabled', true);


            $('#worker_operator_id').children('option[value="' + '' + '"]').removeAttr("disabled");
            $('#worker_hoseman_id').children('option[value="' + '' + '"]').removeAttr("disabled");
            $('#worker_extraman1_id').children('option[value="' + '' + '"]').removeAttr("disabled");
            $('#worker_extraman2_id').children('option[value="' + '' + '"]').removeAttr("disabled");
            $('#worker_extraman3_id').children('option[value="' + '' + '"]').removeAttr("disabled");

        }



        $('.btn-cancel').on('click', function() {
            window.location = "{{ route('bookings.index') }}";
        });

        $('.btn-credit-submit').on('click', function() {
            $('#update-booking-div').css('background-color', '#fa7268');
        });


        const bookingStatus = document.querySelector('#booking_status');
        const price_preview = document.querySelector('#price_preview');

        if (bookingStatus.value === 'Unallocated') {
            price_preview.style.display = 'none';
        }

        bookingStatus.addEventListener('change', function() {
            if (bookingStatus.value === 'Unallocated') {
                price_preview.style.display = 'none';
            } else {
                price_preview.style.display = 'block';
            }
        });

        // Load saved project and project address for the booking
        var projectId = {{ $booking->project_id ?? 0 }};
        var projectAddressId = {{ $booking->project_address_id ?? 0 }};




        // Populate project address dropdown
        var projectAddressDropdown = jQuery("#project_address_id");
        projectAddressDropdown.empty();
        var selectedProject = projects.find(function(project) {
            return project.id == projectId;
        });
        if (selectedProject) {
            if (selectedProject.addresses.length > 0) {
                selectedProject.addresses.forEach(function(address) {
                    projectAddressDropdown.append('<option value="' +
                        address.id + '">' + address.address + ', ' + address.suburb + ', ' +
                        address.state + ', ' + address.postcode + '</option>');
                });
                projectAddressDropdown.val(projectAddressId);
            } else {
                projectAddressDropdown.append('<option value="">No address for this project</option>');
                projectAddressDropdown.val(""); // set projectAddressId to null
            }
        } else {
            projectAddressDropdown.append('<option value="">Select Job Address</option>');
            projectAddressDropdown.val(""); // set projectAddressId to null
        }


        function checkBadCredit() {
            var clientId = {{ $booking->client->id ?? 0 }}

            $.get('/clients/' + clientId + '/bad_credit', function(responseText) {
                if (responseText === '1') {
                    $('#update-booking-div').css('background-color', '#fa7268');
                }
            });
        }

        $(document).on("keydown", "form", function(event) { 
            return event.key != "Enter";
        });


    </script>
@endsection

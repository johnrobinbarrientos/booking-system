@extends('../layout/' . $layout)

@section('subhead')
    <title>All Bookings | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    @if ($message = Session::get('success'))
        <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2 mt-5"
            role="alert">
            <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ $message }}
            <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x"
                    class="w-4 h-4"></i>
            </button>
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">All Bookings</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('bookings.create') }}" class="btn btn-primary shadow-md mr-2">Create New Booking</a>
            <div class="w-56"></div>
            <div class="col-span-12">
                <h2 class="intro-y col-span-12 text-primary items-center mt-2 text-lg text-medium text-center">{{$duration_message}}</h2>
            </div>

            {{-- <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56">
                    <!--<input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>-->
                </div>

                <div class="col-span-12">
                    <h2 class="intro-y col-span-10 items-center mt-2 text-lg font-medium text-center ">{{$duration_message}}</h2>
                </div>
            </div> --}}
        </div>
        <!-- BEGIN: Weekly Top Products -->
        <div class="col-span-12 mt-6">
            <form class="booking-form-filter" id="booking-form-filter" method="get" action="{{ url('bookings') }}">
                <div class="intro-y block sm:flex items-center h-10 sm:mb-10">
                    <div class="flex flex-col mr-2 ml-2">
                        <label for="">Date</label>
                        <select name="booking_filter" id="booking_filter" class="form-control">
                            <option value="">Select Date</option>
                            <option value="1" @if (\Request::get('booking_filter') == 1) {{ 'selected' }} @endif>Today
                            </option>
                            <option value="2" @if (\Request::get('booking_filter') == 2) {{ 'selected' }} @endif>Tomorrow
                            </option>
                            <option value="3" @if (\Request::get('booking_filter') == 3) {{ 'selected' }} @endif>Next Week
                            </option>
                            <option value="4" @if (\Request::get('booking_filter') == 4) {{ 'selected' }} @endif>Next Month
                            </option>
                            <option value="5" @if (\Request::get('booking_filter') == 5) {{ 'selected' }} @endif>Last Week
                            </option>
                            <option value="6" @if (\Request::get('booking_filter') == 6) {{ 'selected' }} @endif>Last Month
                            </option>
                            <option value="7" @if (\Request::get('booking_filter') == 7) {{ 'selected' }} @endif>Date Search
                            </option>
                            <option value="8" @if (\Request::get('booking_filter') == 8) {{ 'selected' }} @endif>Date Range Search
                            </option>
                        </select>
                    </div>

                    @php $date = ''; @endphp
                    @if (\Request::get('date'))
                        @php $date = \Request::get('date'); @endphp
                    @endif
                    @if (\Request::get('booking_filter') == 7)
                        @php $class = ''; @endphp
                    @else
                        @php $class = 'hidden'; @endphp
                    @endif
                    @if (\Request::get('booking_filter') == 8)
                    @php $hclass = ''; @endphp
                    @else
                        @php $hclass = 'hidden'; @endphp
                    @endif
                    <div class="flex flex-col mr-2 {{ $class }}" id="date-picker-div">
                        <input type="date" name="date" id="dateInput" class="bg-gray-50 border border-gray-300 text-gray-900 mt-5"
                            onchange="this.form.submit()" value="{{ $date }}">
                    </div>
                    <div class="flex flex-col mr-2 ml-2 {{ $hclass }}" id="date-range-picker-div">
                        <input type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 mt-5" name="daterange" id="daterange"/>
                    </div>

                    <div class="flex flex-col mr-1 ml-1">
                        <label for="">Status</label>
                        <select name="booking_status" id="booking_status" class="form-control" onchange="this.form.submit()">
                            <option value="">Select Status</option>
                            <option value="1" @if (\Request::get('booking_status') == 1) {{ 'selected' }} @endif>Confirmed
                            </option>
                            <option value="2" @if (\Request::get('booking_status') == 2) {{ 'selected' }} @endif>Allocated
                            </option>
                            <option value="3" @if (\Request::get('booking_status') == 3) {{ 'selected' }} @endif>Shadow Booking
                            </option>
                            <option value="4" @if (\Request::get('booking_status') == 4) {{ 'selected' }} @endif>Canceled
                            </option>
                            <option value="5" @if (\Request::get('booking_status') == 5) {{ 'selected' }} @endif>Unallocated
                            </option>
                            <option value="6" @if (\Request::get('booking_status') == 6) {{ 'selected' }} @endif>Complete
                            </option>
                            <option value="7" @if (\Request::get('booking_status') == 7) {{ 'selected' }} @endif>Jobs To Check
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-col mr-1 ml-1">
                        <label for="">Client</label>
                        <select name="client_id" id="client_id" class="form-control mr-2" onchange="this.form.submit()">
                            <option value ="" >Select Client</option>
                            @foreach ($clients as $client)
                                <option @selected($client->id == $client_id) value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                            <option value="NONE" @if (\Request::get('client_id') == "NONE") {{ 'selected' }} @endif>NONE</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <button type="button"
                            class="btn box flex items-center text-primary dark:text-slate-300 border border-primary mt-5 sm:ml-1 btn-reset">Reset</button>
                    </div>
                    <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <a href="{{ route('bookings.export', ['duration' => $duration ?? 0, 'date' => $date ?? 0, 'daterange' => $daterange ?? 0, 'status' => $booking_status ?? 0, 'client_id' => $client_id ?? 0]) }}"
                            class="btn box flex items-center text-primary dark:text-slate-300 border border-primary">
                            <i data-lucide="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to CSV
                        </a>
                    </div>
                </div>
            </form>
            <div class="intro-y overflow-auto lg:overflow-visible mt-10 sm:mt-15">
                <table class="table table-striped table-responsive 2xl:mt-2">
                    <thead>
                        <tr>
                            <th class="">@sortablelink('job_date', 'Project Delivery Date')</th>
                            <!-- <th class="">@sortablelink('booking_number', 'Booking Number')</th> -->
                            <th class="">@sortablelink('concrete_time', 'Concrete Time')</th>
                            <th class="">@sortablelink('clientDetail.name', 'Client')</th>
                            <th class="">Site Contact</th>
                            <th class="">Job Address</th>
                            <!-- <th class="">Worker assigned</th> -->
                            <th class="">@sortablelink('metres_to_pump', 'Volume m3')</th>
                            <th class="">@sortablelink('concreteTypeDetail.concrete_type', 'Job Type')</th>
                            <th class="">@sortablelink('pumpPriceDetail.size', 'Pump Size')</th>
                            <th class="">@sortablelink('pumpDetail.pump_name', 'Pump')</th>
                            <th>@sortablelink('booking_status', 'Status')</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                        <?php $background_color =  App\Models\Booking::STATUS_COLOR[$booking->booking_status] ?? 'none' ?>
                            <tr>
                                <td style="background-color:{{$background_color}};" >{{Carbon\Carbon::parse($booking->job_date ?? 'No Date')->toFormattedDateString()}}</td>
                                <!-- <td style="background-color:{{$background_color}};" class="">
                                    {{ $booking->booking_number }}
                                </td> -->
                                <td style="background-color:{{$background_color}};" >
                                    <div class="time-contain">
                                        {{ Carbon\Carbon::parse($booking->concrete_time)->format('h:i A') }}</div>
                                </td>
                                <td style="background-color:{{$background_color}};" class="">
                                    @if ($booking->client_id)
                                    <a href="{{ route('clients.show', $booking->client->id) }}"
                                        class="font-medium whitespace-nowrap">{{ $booking->client ? $booking->client->name : '' }}</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$booking->PriceGroup->location_name ?? ''}}</div>
                                    @else
                                        NONE
                                    @endif
                                </td>
                                @if ($booking->project_id)
                                    <td class="font-medium" style="background-color:{{$background_color}};">
                                        @if ($booking->project && $booking->project->contacts()->where('is_primary', 1)->first())
                                            {{ $booking->project->contacts()->where('is_primary', 1)->first()->contact_name }}
                                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                                {{ $booking->project->contacts()->where('is_primary', 1)->first()->contact_phone }}
                                            </div>
                                        @else
                                            <!-- No primary contact found. -->
                                        @endif
                                    </td>
                                    <td style="background-color:{{$background_color}};">
                                        @forelse ($booking->project->addresses as $address)
                                            <p class="text-sm">
                                                {{ $address->address }}
                                                {{ $address->suburb }}
                                                {{ $address->state }}
                                                {{ $address->postcode }}
                                            </p>
                                        @empty

                                        @endforelse
                                    </td>
                                @else
                                    <td style="background-color:{{$background_color}};">
                                        {{$booking->project_none_contact_name ?? ''}}
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                            {{ $booking->project_none_contact_no ?? '' }}
                                        </div>
                                    </td>
                                    <td style="background-color:{{$background_color}};">{{$booking->project_none_contact_address ?? ''}}</td>
                                @endif
                                <!-- <td style="background-color:{{$background_color}};" class="">
                                    <div class="flex">
                                        <div class="mr-3">
                                            @if ($booking->workerOperator)
                                                {{ $booking->workerOperator->first_name ?? '' }} {{ $booking->workerOperator->last_name ?? '' }}<br>
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    {{ 'Operator' }}</div>
                                                <br>
                                            @endif
                                            @if ($booking->workerHoseman)
                                                {{ $booking->workerHoseman->first_name ?? '' }} {{ $booking->workerHoseman->last_name ?? '' }}<br>
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    {{ 'Hoseman' }}</div>
                                                <br>
                                            @endif
                                            @if ($booking->workerExtraman1)
                                                {{ $booking->workerExtraman1->first_name ?? '' }} {{ $booking->workerExtraman1->last_name ?? '' }}<br>
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    {{ 'Extraman 1' }}</div>
                                                <br>
                                            @endif
                                            @if ($booking->workerExtraman2)
                                                {{ $booking->workerExtraman2->first_name ?? '' }} {{ $booking->workerExtraman2->last_name ?? '' }}<br>
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    {{ 'Extraman 2' }}</div>
                                                <br>
                                            @endif
                                            @if ($booking->workerExtraman3)
                                                {{ $booking->workerExtraman3->first_name ?? '' }} {{ $booking->workerExtraman3->last_name ?? '' }}<br>
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    {{ 'Extraman 3' }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td> -->
                                <td style="background-color:{{$background_color}};" class="">
                                    {{ $booking->metres_to_pump }}
                                </td>
                                <td style="background-color:{{$background_color}};">
                                    {{$booking->concreteType->concrete_type ?? ''}}
                                </td>
                                <td style="background-color:{{$background_color}};" class="">
                                    {{ $booking->PumpPrice->size ?? '' }} - &nbsp;
                                    {{ $booking->PumpCategory->category_name ?? '' }}
                                </td>
                                <td style="background-color:{{$background_color}};" class="">
                                    {{ $booking->pump->pump_name ?? '' }} - &nbsp;
                                    {{ $booking->pump->plant_number ?? '' }}
                                </td>
                                <td style="background-color:{{$background_color}};">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full"
                                        style="background-color:{{ App\Models\Booking::STATUS_COLOR[$booking->booking_status] ?? 'none' }};">
                                        {{ $booking->booking_status }}
                                    </span>
                                </td>
                                <td style="background-color:{{$background_color}};" class="">

                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3 text-primary"
                                            href="{{ route('hist', $booking->id) }}"> <i data-lucide="clock"
                                                class="w-4 h-4 mr-1"></i> Hist </a>

                                        <a class="flex items-center mr-3 "
                                            href="{{ route('bookings.edit', $booking->id) }}">
                                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                        </a>

                                        <a class="flex items-center mr-3 text-warning btn-duplicate"
                                        href="javascript:;" data-tw-toggle="modal" data-tw-target="#duplicate-modal"
                                            data-booking-id="{{ $booking->id }}">
                                            <i data-lucide="copy" class="w-4 h-4 mr-1"></i> Duplicate
                                        </a>
                                    </div>

                                    <!-- <div class="flex justify-center items-center">
                                        <a class="btn btn-primary btn-sm mr-3"
                                            href="{{ route('hist', $booking->id) }}"> 
                                            <i data-lucide="clock" class="w-4 h-4 mr-1"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm mr-3"
                                            href="{{ route('bookings.edit', $booking->id) }}">
                                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                        </a>
                                        <a class="flex items-center mr-3 btn btn-pending btn-sm btn-duplicate"
                                            href="javascript:;" data-tw-toggle="modal" data-tw-target="#duplicate-modal"
                                            data-booking-id="{{ $booking->id }}">
                                            <i data-lucide="copy" class="w-4 h-4 mr-1"></i>
                                        </a>
                                    </div>  -->
                                    <!-- <button id="apple-ipad-air-dropdown-button" data-dropdown-toggle="apple-ipad-air-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-ipad-air-dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <div class="py-1">
                                            <a href="{{ route('hist', $booking->id) }}" class="btn-hist block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Hist</a>
                                        </div>
                                        <div class="py-1">
                                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn-edit block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                        </div>
                                        <div class="py-1">
                                            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#duplicate-modal"
                                                data-booking-id="{{ $booking->id }}" class="btn-duplicate block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Duplicate</a>
                                        </div>
                                    </div> -->
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-danger text-xl text-center">No Records Found </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex">
                    {!! $bookings->withQueryString()->links() !!}
                </div>
            </div>
        </div>
        <!-- END: Weekly Top Products -->
    </div>
    <!-- Modal container -->
    <div id="duplicate-modal" class="modal modal-lg" tabindex="-1" aria-hidden="true" style="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0 w-full">
                    <div class="pt-5 pl-5">
                        <h2 class="text-xl text-center text-primary pb-4">Duplicate Booking</h2>
                        <div id="messageAlert" class="alert alert-dismissible flex items-center mb-2 mr-4"
                            role="alert">
                            <span></span>
                            <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i
                                    data-lucide="x" class="w-4 h-4"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="booking_id" id="booking_id">
                    <fieldset class=" p-5">
                        <div class="">
                            <div class="flex flex-col mb-5">
                                <label for="">Booking From Date</label>
                                <input type="date" name="booking_from_date" class="bg-gray-50 border border-gray-300 text-gray-900"
                                    id="booking_from_date">
                            </div>
                            <div class="flex flex-col mb-5">
                                <label for="">Booking To Date</label>
                                <input type="date" name="booking_to_date" class="bg-gray-50 border border-gray-300 text-gray-900" id="booking_to_date">
                            </div>
                            <div class="" style="display: inline-flex; align-items: center;">
                                <label for="" style="margin-right: 0.5em;">Include Weekend</label>
                                <input type="checkbox" name="is_include_weekend"
                                    class="is_include_weekend form-check-input" required="required"
                                    id="is_include_weekend" value="1">
                            </div>
                            <div class="pt-4 mt-5">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn  border-slate-300 text-slate w-24 mr-1">Close</button>
                                <button type="button"
                                    class="btn-duplicate-submit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Save</button>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"  rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript">

        var bookings = {!! $bookings->toJson() !!};
        var clients = {!! $clients->toJson() !!};

        function setClient(){
            var clientId = {{ $client_id ?? 0 }};

            for (let i = 0; i < clients.length; i++) {
                if(clients[i].id == clientId){
                    jQuery("#client_id").val(clients[i].id);
                }
            }
        }

        $(document).on('click','.btn-edit', function(e) {
            e.preventDefault();
            var aid = $(this).data('id');
            alert(aid);
        });


        setTimeout(function() {
            $('#successAlert').remove();
        }, 4000);

        $('input[name="daterange"]').daterangepicker({
            locale: {
              format: 'YYYY-MM-DD'
            }
        });
        
        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            console.log(picker.startDate.format('YYYY-MM-DD'));
            console.log(picker.endDate.format('YYYY-MM-DD'));
            console.log($(this).val());
            
            this.form.submit();
        });

        $(document).ready(function() {
            setClient();

            $('.btn-reset').on('click', function(e) {
                window.location = "{{ url('bookings') }}";
            });

            $('.btn-duplicate').on('click', function() {
                var booking_id = $(this).data('booking-id');

                $('#duplicate-modal').find('#booking_id').val(booking_id);
            });

            $('.btn-duplicate-submit').on('click', function() {
                var booking_from_date = $('#duplicate-modal').find('#booking_from_date').val();
                var booking_to_date = $('#duplicate-modal').find('#booking_to_date').val();
                if($('#duplicate-modal').find('#is_include_weekend').is(':checked')){
                    var is_include_weekend = 1;
                }else{
                    var is_include_weekend = 0;
                }

                // Log the form data to the console
                console.log('Booking From Date:', booking_from_date);
                console.log('Booking To Date:', booking_to_date);
                console.log('Is Include Weekend:', is_include_weekend);

                if (booking_from_date == '') {
                    $('#messageAlert').addClass('alert-danger-soft show');
                    $('#messageAlert span').html('Please Select From Date');
                    return false;
                }
                if (booking_to_date == '') {
                    $('#messageAlert').addClass('alert-danger-soft show');
                    $('#messageAlert span').html('Please Select To Date');
                    return false;
                }

                let url = '{{ route('duplicateBooking') }}';
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                console.log(csrfToken);

                jQuery.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        'booking_from_date': $('#duplicate-modal').find('#booking_from_date').val(),
                        'booking_to_date': $('#duplicate-modal').find('#booking_to_date').val(),
                        'booking_id': $('#duplicate-modal').find('#booking_id').val(),
                        'is_include_weekend': is_include_weekend
                        
                    },
                    success: function(response) {
                        console.log(response);
                        $('#messageAlert').removeClass('alert-danger-soft');
                        $('#messageAlert').addClass('alert-success-soft show');
                        $('#messageAlert span').html(response.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                        return false;
                    }
                });
            });

            $('#booking_filter').on('change', function(e) {
                console.log($(this).val());
                if ($(this).val() == 7) {
                    e.stopPropagation();
                    $('#date-picker-div').removeClass('hidden');
                    $('#date-range-picker-div').addClass('hidden');
                }else if ($(this).val() == 8) {
                    e.stopPropagation();
                    $('#date-picker-div').addClass('hidden');
                    $('#date-range-picker-div').removeClass('hidden');
                }  else {
                    $('#date-picker-div').addClass('hidden');
                    this.form.submit();
                }
            });
        });
    </script>
@endsection

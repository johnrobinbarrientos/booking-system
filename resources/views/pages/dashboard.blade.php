@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h1 class="text-lg font-medium truncate mr-5">General Report</h1>
                        <a href="" class="ml-auto flex items-center text-primary">
                            <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                        </a>
                    </div>
                    <!--- BEGIN VALUE SECTION----->
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <!--- BEGIN BOX---->
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="alert-circle" class="report-box__icon text-pending"></i>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">
                                        {{ $unAllocatedBookings }}
                                    </div>
                                    <div class="text-base text-slate-500 mt-1">Unallocated Bookings for today</div>
                                </div>
                            </div>
                        </div>
                        <!--- END BOX-----> 
                        <!--- BEGIN BOX---->
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="check-circle-2" class="report-box__icon text-success"></i>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">
                                        {{ $confirmedBookingsForToday }}
                                    </div>
                                    <div class="text-base text-slate-500 mt-1">Confirmed bookings for today</div>
                                </div>
                            </div>
                        </div>
                        <!--- END BOX----->
                        <!--- BEGIN BOX---->
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="history" class="report-box__icon text-success"></i>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $totalBookingsThisWeek }}</div>
                                    <div class="text-base text-slate-500 mt-1">Total bookings this week</div>
                                </div>
                            </div>
                        </div>
                        <!--- END BOX----->
                    </div>
                    <!--- BEGIN VALUE SECTION----->
                </div>
                <!-- END: General Report -->

                <!-- BEGIN: Weekly Top Products -->
                <div class="col-span-12 mt-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Todays Bookings</h2>
                    </div>
                    <div class="intro-y overflow-auto lg:overflow-visible mt-8">
                        @if ($message = Session::get('success'))
                            <div id="successAlert"
                                class="alert alert-success-soft alert-dismissible show flex items-center mb-2"
                                role="alert">
                                <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ $message }}
                                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i
                                        data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </div>
                        @endif
                        <div class="intro-y block sm:flex items-center h-10">
                            <div class="flex flex-col">
                                <label for="">Filter</label>
                                <form class="form-inline" method="get" action="{{route('dashboard')}}" id="date-filter-form">
                                    @if(\Request::get('date'))
                                        @php $date = \Request::get('date'); @endphp
                                    @else
                                        @php $date = \Carbon\Carbon::now()->format('Y-m-d'); @endphp
                                    @endif    
                                    <input type="date" name="date" id="dateInput" class="bg-gray-50 border border-gray-300 text-gray-900" value="{{$date}}">
                                    <button type="submit"
                                    class="btn box items-center text-primary dark:text-slate-300 border border-primary  sm:ml-1 btn-reset">Apply</button>
                                </form>
                            </div>
                            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                                <a href="{{route('bookings.todayBookingExport')}}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                                    <i data-lucide="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to Excel
                                </a>
                            </div>
                        </div>
                        <div class="intro-y overflow-auto lg:overflow-visible mt-10 sm:mt-15">
                            <table class="table table-report 2xl:mt-2" id="bookings-table">
                                <thead>
                                    <tr>
                                        <th class="">Project Delivery Date</th>
                                        <th class="">Start Time</th>
                                        <th class="">Concrete Time</th>
                                        <th class="">Client</th>
                                        <th class="">Site Contact</th>
                                        <th class="">Job Address</th>
                                        <th class="">Worker assigned</th>
                                        <th class=" ">Volume m3</th>
                                        <th class=" ">Job Type</th>
                                        <th class=" ">Pump size</th>
                                        <th class=" ">Pump</th>
                                        <th class="">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($bookingsForToday->isEmpty())
                                        <span class="text-lg text-danger"> No bookings for today</span>
                                    @else
                                        @foreach ($bookingsForToday as $booking)
                                            <?php $background_color =  App\Models\Booking::STATUS_COLOR[$booking->booking_status] ?? 'none' ?>
                                            <tr>
                                                <td style="background-color:{{$background_color}};">{{Carbon\Carbon::parse($booking->job_date ?? 'No Date')->toFormattedDateString()}}</td>
                                                <td style="background-color:{{$background_color}};">
                                                    {{ Carbon\Carbon::parse($booking->job_start_time)->format('h:i:s A') ?? '' }}
                                                </td>
                                                <td style="background-color:{{$background_color}};">
                                                    <div class="time-contain">
                                                        {{ Carbon\Carbon::parse($booking->concrete_time)->format('h:i:s A') }}
                                                    </div>
                                                </td>
                                                <td style="background-color:{{$background_color}};">
                                                    @if ($booking->client_id)
                                                    <a href="{{ route('clients.show', $booking->client->id) }}"
                                                        class="font-medium whitespace-nowrap">{{ $booking->client ? $booking->client->name : '' }}</a>
                                                        <div class="text-slate-500 text-xs mt-0.5">{{$booking->PriceGroup->location_name ?? ''}}</div>
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
                                                <td style="background-color:{{$background_color}};">
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
                                                </td>
                                                <td style="background-color:{{$background_color}};">
                                                    {{$booking->metres_to_pump}}
                                                </td>
                                                <td style="background-color:{{$background_color}};">
                                                    {{$booking->concreteType->concrete_type ?? ''}}
                                                </td>
                                                <td style="background-color:{{$background_color}};">
                                                    {{$booking->PumpPrice->size ?? ''}}
                                                </td>
                                                <td style="background-color:{{$background_color}};">
                                                    <input type="hidden" class="booking-id-input" value="{{ $booking->id }}"> 
                                                            <select name="pump_id" class="pump_id_change" data-booking-id="{{ $booking->id }}">
                                                            @foreach($pumps as $pump)
                                                                <option value="{{ $pump->id }}" {{ $booking->pump_id == $pump->id ? 'selected' : '' }}>
                                                                    {{ $pump->plant_number }}
                                                                </option>
                                                            @endforeach
                                                            </select>
                                                </td>
                                                
                                                <td  style="background-color:{{$background_color}};">
                                                    <form>
                                                        @csrf
                                                        <select name="booking_status" class="booking_status_class"
                                                            data-booking-id="{{ $booking->id }}">
                                                            <option value="Confirmed"
                                                                {{ $booking->booking_status === 'Confirmed' ? 'selected' : '' }}>
                                                                Confirmed
                                                            </option>
                                                            <option value="Allocated"
                                                                {{ $booking->booking_status === 'Allocated' ? 'selected' : '' }}>
                                                                Allocated
                                                            </option>
                                                            <option value="Shadow Booking"
                                                                {{ $booking->booking_status === 'Shadow Booking' ? 'selected' : '' }}>
                                                                Shadow Booking</option>
                                                            <option value="Canceled"
                                                                {{ $booking->booking_status === 'Canceled' ? 'selected' : '' }}>
                                                                Canceled
                                                            </option>
                                                            <option value="Unallocated"
                                                            {{ $booking->booking_status === 'Unallocated' ? 'selected' : '' }}>
                                                            Unallocated
                                                            <option value="Complete"
                                                            {{ $booking->booking_status === 'Complete' ? 'selected' : '' }}>
                                                            Complete
                                                            <option value="Jobs To Check"
                                                            {{ $booking->booking_status === 'Jobs To Check' ? 'selected' : '' }}>
                                                            Jobs To Check
                                                        </option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td class="" style="background-color:{{$background_color}};">
                                                    <div class="flex justify-center items-center">
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
                                                            <!-- <button id="apple-ipad-air-dropdown-button" data-dropdown-toggle="apple-ipad-air-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                                </svg>
                                                            </button>
                                                            <div id="apple-ipad-air-dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                                <div class="py-1">
                                                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                                </div>
                                                                <div class="py-1">
                                                                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#duplicate-modal"
                                                                        data-booking-id="{{ $booking->id }}" class="btn-duplicate block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Duplicate</a>
                                                                </div>
                                                            </div> -->
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {!! $bookingsForToday->links() !!}
                        </div>
                    </div>
                </div>
                <!-- END: Weekly Top Products -->
            </div>
        </div>
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

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"  rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        setTimeout(function() {
            $('#successAlert').remove();
        }, 4000);

        //Update booking status
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const booking_status = document.getElementsByClassName("booking_status_class");
        for (let i = 0; i < booking_status.length; i++) {
            booking_status[i].addEventListener("change", function() {
                const selectedOption = this.value;
                const bookingId = this.dataset.bookingId;
                const url = 'route_to_update_booking_status/' + bookingId;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            'booking_status': selectedOption
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message == "Booking status updated successfully") {
                            location.reload();
                        }
                    })
                    .catch(error => console.error(error));
            });
        } //end for loop

        //fetch bookings by date 
        const dateInput = document.getElementById("dateInput");

        dateInput.addEventListener("change", function() {
            $('#date-filter-form').submit();
        });

        //change pump dropdown 
        $(document).ready(function(){

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



            $('.pump_id_change').on('change',function(){

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var booking_id = $(this).data('booking-id');
                let pump_id = $(this).val();
                let url = '{{ route("updatePump", ":id") }}';
                url = url.replace(':id', booking_id);
                // console.log(booking_id,pump_id,url,csrfToken);

                jQuery.ajax({
                    url: url,
                    type: 'post',
                    headers: {
                            // 'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                    data: {'pump_id':pump_id},
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.message == 'Pump updated successfully.') {
                           location.reload();
                        }
                    },
                    error: function(error){
                        console.error(error);
                    }
                });
            });
        });
    
    </script>
@endsection

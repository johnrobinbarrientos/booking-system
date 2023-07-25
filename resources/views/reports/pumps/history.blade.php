@extends('../layout/' . $layout)

@section('subhead')
    <title>Pumps Financial History | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h1 class="intro-y text-lg font-medium mt-10">Pump History</h1><br>
    <div class="w-full">
        <div class="flex flex-col">
            <form class="pump-history-filter" id="pump-history-filter" method="get"
                action="{{ url('pumpHistory') }}">
                <div class="intro-y block sm:flex items-center h-10">
                    <div class="flex">
                        <div class="flex mr-2">
                            <div id="daterangepicker">
                                <div class="preview">
                                    <input type="text" data-daterange="true" name="job_date" value="{{ $job_date }}" class="datepicker form-control w-56 block mx-auto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <select name="client_id" id="client_id"
                            class="form-control mr-2">
                            <option value ="" >Select a Client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="docket_no" id="docket_no" value="{{ $docket_no }}" placeholder="Enter Docket No" class="form-control mr-2">
                        <select name="pump_id" id="pump_id"
                            class="form-control mr-2">
                            <option value ="" >Select a Pump</option>
                            @foreach ($pumps as $pump)
                                <option value="{{ $pump->id }}">{{ $pump->pump_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex">
                        <button type="submit"
                            class="btn box items-center text-primary dark:text-slate-300 border border-primary  sm:ml-1 btn-reset">Apply</button>
                        <button type="button"
                            class="btn box flex items-center text-primary dark:text-slate-300 border border-primary  sm:ml-1 btn-reset">Reset</button>
                    </div>
                    <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                    
                    
                    
                        <a href="{{ route('exportHistory', ['client_id' => $client_id ?? 0, 'docket_no' => $docket_no ?? 0, 'job_date' => $job_date ?? 0, 'pump_id' => $pump_id ?? 0]) }}"
                          class="btn box flex items-center text-primary dark:text-slate-300 border border-primary">
                          <i data-lucide="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to CSV
                      </a>
                  </div>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table mt-5">
                <thead class="table-light uppercase">
                    <tr>
                        <th class="text-center">Pump name</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Client</th>
                        <th class="text-center">Job Address</th>
                        <th class="text-center">Job Type</th>
                        <th class="text-center">Docket Number</th>
                        <th class="text-center">Metres Pumped (M3)</th>
                        <th class="text-center">Total Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td class="text-center">{{$booking->pump->pump_name ?? ''}}</td>
                        <td class="text-center">{{$booking->job_date ?? ''}}</td>
                        <td class="text-center">{{$booking->client->name ?? ''}}</td>
                        @if ($booking->project_id)
                            <td class="text-center">
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
                        <td class="text-center">{{$booking->project_none_contact_address ?? ''}}</td>
                        @endif
                        <td class="text-center">{{$booking->concrete_type ?? ''}}</td>
                        <td class="text-center">{{$booking->docket_no ?? ''}}</td>
                        <td class="text-center">{{$booking->metres_pumped ?? ''}}</td>
                        <td class="text-center">{{$booking->grand_total ?? ''}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="mt-5">
                {!! $bookings->appends(request()->all())->links() !!}
                <!-- {{-- pagination --}} -->
            </div>
        </div>
        <!-- END: Data List -->
    </div>
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        $(document).ready(function() {
            $('.btn-reset').on('click', function(e) {
                window.location = "{{ url('pumpHistory') }}";
            });

            setClient();
            setPump();
        });

        var clients = {!! $clients->toJson() !!};
        var pumps = {!! $pumps->toJson() !!};

        function setClient(){
            var clientId = {{ $client_id ?? 0 }};

            for (let i = 0; i < clients.length; i++) {
                if(clients[i].id == clientId){
                    jQuery("#client_id").val(clients[i].id);
                }
            }
        }

        function setPump(){
            var pumpId = {{ $pump_id ?? 0 }};

            for (let i = 0; i < pumps.length; i++) {
                if(pumps[i].id == pumpId){
                    jQuery("#pump_id").val(pumps[i].id);
                }
            }
        }

    </script>
@endsection

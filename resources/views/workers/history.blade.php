@extends('../layout/' . $layout)

@section('subhead')
    <title>Worker Job History | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h1 class="intro-y text-lg font-medium mt-10">Worker Job History</h1><br>

    <div class="w-full">
        <div class="flex flex-col">
            <form class="worker-history-filter" id="worker-history-filter" method="get"
                action="{{ url('workerHistory') }}">
                <div class="intro-y block sm:flex items-center h-10">
                    <div class="flex">
                        <select name="worker_id" id="worker_id" onchange="this.form.submit()"
                            class="form-control mr-2">
                            @foreach ($workers as $worker)
                                <option @selected($worker->id == $worker_id) value="{{ $worker->id }}">{{ $worker->first_name }} {{ $worker->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <a href="{{ route('exportWorkerJobHistory', ['worker_id' => $worker_id ?? 0]) }}"
                          class="btn box flex items-center text-primary dark:text-slate-300 border border-primary">
                          <i data-lucide="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to CSV
                      </a>
                  </div>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table mt-5">
                <thead class="table-light uppercase">
                    <tr>
                        <th class="text-center">Job Date</th>
                        <th class="text-center">Booking Status</th>
                        <th class="text-center">Client</th>
                        <th class="text-center">Job Address</th>
                        <th class="text-center">Pump No.</th>
                        <th class="text-center">Job Type</th>
                        <th class="text-center">M3 Concrete Pumped</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td class="text-center">{{$booking->job_date ?? ''}}</td>
                        <td class="text-center">{{$booking->booking_status ?? ''}}</td>
                        <td class="text-center">
                            @if ($booking->client_id)
                            {{$booking->client->name ?? ''}}
                            @else
                                NONE
                            @endif
                        </td>
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
                        <td class="text-center">{{$booking->actual_pump_sent ?? ''}}</td>
                        <td class="text-center">{{$booking->concrete_type ?? ''}}</td>
                        
                        <td class="text-center">{{$booking->metres_pumped ?? ''}}</td>
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

        var bookings = {!! $bookings->toJson() !!};

        console.log('bookings')
        console.log(bookings)


    </script>
@endsection

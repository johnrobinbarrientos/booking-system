@extends('../layout/' . $layout)

@section('subhead')
    <title>Clients Financial History | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h1 class="intro-y text-lg font-medium mt-10">Clients Financial History</h1><br>
    <div class="w-full">
        <div class="flex flex-col">
            <form class="client-history-filter" id="client-history-filter" method="get"
                action="{{ url('clientFinancialHistory') }}">
                <div class="intro-y block sm:flex items-center h-10">
                    <div class="flex flex-col">
                        <select name="client_history_filter" id="client_history_filter" onchange="this.form.submit()"
                            class="form-control">
                            <option selected disabled>Select a Search Filter</option>
                            <option value="past_7_years" @if (\Request::get('client_history_filter') == 'past_7_years') {{ 'selected' }} @endif>Past 7
                                Years</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <button type="button"
                            class="btn box flex items-center text-primary dark:text-slate-300 border border-primary  sm:ml-1 btn-reset">Reset</button>
                    </div>
                    <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                      <a href="{{ route('clientFinancialHistory.export') }}"
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
                        <th class="text-center">client name</th>
                        <th class="text-center">total projects</th>
                        <th class="text-center">Total Including Tax</th>
                        <th class="text-center">Total Without Tax</th>
                        <th class="text-center">Average Per Job Excluding Tax</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        @if (!empty($client->bookings))
                            <tr>
                                <td class="text-center">{{ $client->name ?? '' }}</td>
                                <td class="text-center">{{ $client->bookings[0]->projects ?? 0 }}</td>
                                <td class="text-center">${{ $client->bookings[0]->grand_total ?? '0.00' }}</td>
                                <td class="text-center">${{ $client->bookings[0]->total_amount_without_gst ?? '0.00' }}</td>
                                <td class="text-center">
                                    @if (($client->bookings[0]->projects ?? 0) && ($client->bookings[0]->projects ?? 0) > 0)
                                        ${{ number_format($client->bookings[0]->total_amount_without_gst / $client->bookings[0]->projects, 2) }}
                                    @else
                                        $0.00
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
            <div class="mt-5">
                {{-- pagination --}}
                {{ $clients->appends(['client_history_filter' => $request->get('client_history_filter')])->links() }}
            </div>
        </div>
        <!-- END: Data List -->
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <Script>
        setTimeout(function() {
            $('#successAlert').remove();
        }, 4000);

        $(document).ready(function() {
            $('.btn-reset').on('click', function(e) {
                window.location = "{{ url('clientFinancialHistory') }}";
            });
        });
    </Script>
@endsection

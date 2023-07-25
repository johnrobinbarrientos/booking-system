@extends('../layout/' . $layout)

@section('subhead')
    <title>Pumps Financial History | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h1 class="intro-y text-lg font-medium mt-10">Pumps Financial History</h1><br>
    <div class="w-full">
        <div class="flex flex-col">
            <form class="pump-history-filter" id="pump-history-filter" method="get"
                action="{{ url('pumpFinancialHistory') }}">
                <div class="intro-y block sm:flex items-center h-10">
                    <div class="flex flex-col">
                        <select name="pump_history_filter" id="pump_history_filter" onchange="this.form.submit()"
                            class="form-control">
                            <option selected disabled>Select a Search Filter</option>
                            <option value="past_7_years" @if (\Request::get('pump_history_filter') == 'past_7_years') {{ 'selected' }} @endif>Past 7
                                Years</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <button type="button"
                            class="btn box flex items-center text-primary dark:text-slate-300 border border-primary  sm:ml-1 btn-reset">Reset</button>
                    </div>
                    <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                      <a href="{{ route('pumpFinancialHistory.export') }}"
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
                        <th class="text-center">Plant No</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">total projects</th>
                        <th class="text-center">Total Including Tax</th>
                        <th class="text-center">Total Without Tax</th>
                        <th class="text-center">Average Per Job Excluding Tax</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td class="text-center">{{$booking->pump->pump_name ?? ''}}</td>
                        <td class="text-center">{{$booking->pump->plant_number ?? ''}}</td>
                        <td class="text-center">{{$booking->PumpPrice->size ?? ''}}</td>
                        <td class="text-center">{{$booking->PumpCategory->category_name ?? ''}}</td>
                        <td class="text-center">{{$booking->projects ?? ''}}</td>
                        <td class="text-center">{{$booking->grand_total ?? '$0.00'}}</td>
                        <td class="text-center">{{$booking->total_amount_without_gst ?? '$0.00'}}</td>
                        <td class="text-center">${{$booking->projects == 0 ? '0.00' : number_format($booking->total_amount_without_gst/$booking->projects, 2)}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="mt-5">
                {{-- pagination --}}
                {{ $bookings->appends(['pump_history_filter' => $request->get('pump_history_filter')])->links() }}
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
                window.location = "{{ url('pumpFinancialHistory') }}";
            });
        });
    </Script>
@endsection

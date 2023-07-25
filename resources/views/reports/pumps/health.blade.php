@extends('../layout/' . $layout)

@section('subhead')
    <title>All Reports | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">
        Reports
    </h2>

    <!-- <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <form class="form-inline" method="GET" action="{{ route('generatePDF') }}">
                @csrf
                <div class="relative rounded-lg shadow-sm mr-3">
                    <select name="pump_id" id="pump_id"
                        class="w-64 form-select py-4 px-5 py-0 leading-5 rounded-md text-gray-700 bg-white border border-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"">
                        <option selected disabled>--Select Pump--</option>
                        @foreach ($pumps as $pump)
                            <option value="{{ $pump->id }}">
                                {{ $pump->pump_name }} &nbsp;
                                {{ $pump->plant_number }} &nbsp;
                                {{ $pump->registration }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="relative rounded-md shadow-sm mr-5">
                    <input type="text" name="total_metres_pumped" value=""
                        class="w-64 form-input py-4 px-5 py-0 leading-5 rounded-md text-gray-700 bg-white border border-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                        id="total_metres_pumped" placeholder="Total Metres Pumped">
                </div>
                <div class="relative rounded-md shadow-sm mr-5">
                    <input type="text" name="file_name" value=""
                        class="w-64 form-input py-4 px-5 py-0 leading-5 rounded-md text-gray-700 bg-white border border-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                        id="file_name" placeholder="Enter file name ">
                </div>
                <div class="relative rounded-md shadow-sm">
                    <button type="submit"
                        class=" inline-flex items-center px-5 py-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white btn btn-primary ">
                        Generate Report PDF
                    </button>
                </div>
            </form>
            <div class="inline-flex items-center px-5 py-4">
                <form class="form-inline" method="GET" action="{{ route('generateWord') }}">
                    @csrf
                    <div class="rounded-md shadow-sm">
                        <button type="submit"
                            class=" inline-flex items-center px-5 py-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white btn btn-primary ">
                            Generate Report Word
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div> -->


    <div class="intro-y box px-5 pt-5 mt-5">
        @if ($message = Session::get('success'))
            <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2"
                role="alert">
                <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ $message }}
                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x"
                        class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        <ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist">
            <li id="pdf-report-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4 flex items-center active" data-tw-target="#pdf-tab"
                    aria-controls="profile" aria-selected="true" role="tab"> <i class="w-4 h-4 mr-2"
                        data-lucide="list"></i>Generated PDF Reports </a>
            </li>
            <li id="word-report-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4 flex items-center" data-tw-target="#word-tab"
                    aria-selected="false" role="tab"> <i class="w-4 h-4 mr-2" data-lucide="list"></i>Generated Docx Reports</a>
            </li>
        </ul>
    </div>

    <div class="tab-content mt-5">
        <div id="pdf-tab" class="tab-pane active" role="tabpanel" aria-labelledby="information-tab">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 2xl:col-span-8">
                    <div class="intro-y box">
                        <div class="flex items-center px-5 py-5 border-b border-gray-200 dark:border-dark-5">
                        <form class="form-inline" method="GET" action="{{ route('generatePDF') }}">
                            @csrf
                            <div class="relative rounded-lg shadow-sm mr-3">
                                <select name="pump_id" id="pump_id"
                                    class="w-64 form-select rounded-md text-gray-700 bg-white border border-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"">
                                    <option selected disabled>--Select Pump--</option>
                                    @foreach ($pumps as $pump)
                                        <option value="{{ $pump->id }}">
                                            {{ $pump->pump_name }} &nbsp;
                                            {{ $pump->plant_number }} &nbsp;
                                            {{ $pump->registration }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="relative rounded-md shadow-sm mr-5">
                                <input type="text" name="total_metres_pumped" value=""
                                    class="w-64 form-input rounded-md text-gray-700 bg-white border border-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                    id="total_metres_pumped" placeholder="Total Metres Pumped">
                            </div>
                            <div class="relative rounded-md shadow-sm mr-5">
                                <input type="text" name="file_name" value=""
                                    class="w-64 form-input rounded-md text-gray-700 bg-white border border-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                    id="file_name" placeholder="Enter file name ">
                            </div>
                            <div class="relative rounded-md shadow-sm">
                                <button type="submit"
                                    class=" inline-flex items-center border border-transparent text-sm font-medium rounded-md text-white btn btn-primary ">
                                    Generate PDF
                                </button>
                            </div>
                        </form>
                        </div>
                        <div class="p-5">
                            <!-- BEGIN: Data List -->
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                <table class="table table-striped table-hover mt-5">
                                    <thead class="border-b bg-indigo-100 border-indigo-200">
                                        <tr>
                                            <th>Name</th>
                                            <th>Download</th>
                                            <th>Generated At</th>
                                            <th>Generated By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pdfs as $pdf)
                                            <tr>
                                                <td>{{ $pdf->name }}</td>
                                                <td>
                                                    <a class="inline-block px-6 py-2.5 btn btn-primary text-white font-medium text-xs leading-tight uppercase rounded shadow-lg "
                                                        href="{{ route('download', $pdf->id) }}">
                                                        Download PDF</a>
                                                    <a class="inline-block px-6 py-2.5 btn btn-danger text-white font-medium text-xs leading-tight uppercase rounded shadow-lg "
                                                        href="{{ route('deletePdf', $pdf->id) }}">
                                                        Delete</a>
                                                </td>
                                                <td>{{ $pdf->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $pdf->user->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $pdfs->links() }}
                            </div>
                            <!-- END: Data List -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="word-tab" class="tab-pane" role="tabpanel" aria-labelledby="password-tab">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 2xl:col-span-8">
                    <div class="intro-y box">
                        <div class="flex items-center px-5 py-5 border-b border-gray-200 dark:border-dark-5">
                            <form class="form-inline" method="GET" action="{{ route('generateWord') }}">
                                @csrf
                                <div class="relative rounded-lg shadow-sm mr-3">
                                    <select name="pump_id_docx" id="pump_id_docx"
                                        class="w-64 form-select rounded-md text-gray-700 bg-white border border-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"">
                                        <option selected disabled>--Select Pump--</option>
                                        @foreach ($pumps as $pump)
                                            <option value="{{ $pump->id }}">
                                                {{ $pump->pump_name }} &nbsp;
                                                {{ $pump->plant_number }} &nbsp;
                                                {{ $pump->registration }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="relative rounded-md shadow-sm mr-5">
                                    <input type="text" name="total_metres_pumped_docx" value=""
                                        class="w-64 form-input rounded-md text-gray-700 bg-white border border-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                        id="total_metres_pumped_docx" placeholder="Total Metres Pumped">
                                </div>
                                <div class="relative rounded-md shadow-sm mr-5">
                                    <input type="text" name="file_name_docx" value=""
                                        class="w-64 form-input rounded-md text-gray-700 bg-white border border-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                        id="file_name" placeholder="Enter file name ">
                                </div>
                                <div class="rounded-md shadow-sm">
                                    <button type="submit"
                                        class=" inline-flex items-center border border-transparent text-sm font-medium rounded-md text-white btn btn-primary ">
                                        Generate Docx
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="p-5">
                                <!-- BEGIN: Data List -->
                                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                <table class="table table-striped table-hover mt-5">
                                    <thead class="border-b bg-indigo-100 border-indigo-200">
                                        <tr>
                                            <th>Name</th>
                                            <th>Download</th>
                                            <th>Generated At</th>
                                            <th>Generated By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($docxs as $docx)
                                            <tr>
                                                <td>{{ $docx->name }}</td>
                                                <td>
                                                    <a class="inline-block px-6 py-2.5 btn btn-primary text-white font-medium text-xs leading-tight uppercase rounded shadow-lg "
                                                        href="{{ route('downloadDocx', $docx->id) }}">
                                                        Download Docx</a>
                                                    <a class="inline-block px-6 py-2.5 btn btn-danger text-white font-medium text-xs leading-tight uppercase rounded shadow-lg "
                                                        href="{{ route('deleteDocx', $docx->id) }}">
                                                        Delete</a>
                                                </td>
                                                <td>{{ $docx->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $docx->user->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- END: Data List -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End: Change Password -->
    </div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        setTimeout(function() {
            $('#successAlert').remove();
        }, 4000);

        jQuery('#pump_id').on('change', function() {
            let id = $(this).val();
            let url = '{{ route('getPumpTotalMetresPumped', ':id') }}';
            url = url.replace(':id', id);
            jQuery.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.totalMetresPumped) {
                        jQuery('#total_metres_pumped').val(response.totalMetresPumped);
                    } else {
                        jQuery('#total_metres_pumped').val('N/A');
                    }
                }
            });
        });

        jQuery('#pump_id_docx').on('change', function() {
            let id = $(this).val();
            let url = '{{ route('getPumpTotalMetresPumped', ':id') }}';
            url = url.replace(':id', id);
            jQuery.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.totalMetresPumped) {
                        jQuery('#total_metres_pumped_docx').val(response.totalMetresPumped);
                    } else {
                        jQuery('#total_metres_pumped_docx').val('N/A');
                    }
                }
            });
        });

    </script>
@endsection

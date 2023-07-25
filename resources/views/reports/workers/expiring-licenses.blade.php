@extends('../layout/' . $layout)

@section('subhead')
    <title>Pumps Financial History | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h1 class="intro-y text-lg font-medium mt-10">Expiring Licenses</h1><br>
    <div class="w-full">
        <div class="flex flex-col">
            <form class="expiring-licenses" id="expiring-licenses" method="get"
                action="{{ url('expiringLicenses') }}">
                <div class="intro-y block sm:flex items-center h-10">
                    <div class="flex">
                        <select name="license_id" id="license_id" onchange="this.form.submit()"
                            class="form-control mr-2" >
                            <option value = 0>Select Licenses Type</option>
                            <option value = 1>Drivers License</option>
                            <option value = 2>HR License</option>
                        </select>
                    </div>
                    <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <a href="{{ route('exportExpiringLicense', ['license_id' => $license_id ?? 0]) }}"
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
                        <th class="text-center">First Name</th>
                        <th class="text-center">Last Name</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">License Expiry</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($workers as $worker)
                    <tr>
                        <td class="text-center">{{$worker->first_name ?? ''}}</td>
                        <td class="text-center">{{$worker->last_name ?? ''}}</td>
                        <td class="text-center">{{$worker->type ?? ''}}</td>
                        <td class="text-center">{{$worker->license_expiry ?? ''}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="mt-5">
                {{-- pagination --}}
            </div>
        </div>
        <!-- END: Data List -->
    </div>
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('.btn-reset').on('click', function(e) {
                window.location = "{{ url('expiringLicenses') }}";
            });
            
            jQuery("#license_id").val({{$license_id}})
        });

    </script>
@endsection

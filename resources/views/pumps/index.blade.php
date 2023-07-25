@extends('../layout/' . $layout)

@section('subhead')
    <title>All Pumps | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">
        All Pumps
    </h2><br>
    <div class="intro-y col-span-12 w-2/3">
        <form action="{{ route('pumps.import') }}" method="POST" enctype="multipart/form-data" class="flex">
            @csrf
            <input type="file" name="file" class="form-control p-2 mr-6 w-56 " style="border:none;">
            <button type="submit" class="btn btn-outline-success w-auto mr-3">CSV Import</button>
            <a href="{{ route('pumps.export', 'demo') }}" class="btn btn-outline-primary w-auto">Download Sample Import</a>
        </form>
    </div>
    @if (isset($errors) && $errors->any())
        <p class="text-red-600">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </p>
    @endif
    <!--@error('file')
        <p class="text-red-600">{{ $message }}</p>
    @enderror-->
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('pumps.create') }}" class="btn btn-primary shadow-md mr-2">Add New Pump</a>
            <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <a href="{{ route('pumps.export', 'all') }}" class="btn btn-primary shadow-md mr-2">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Export to Excel
                </a>
                <div class="w-56 relative text-slate-500">
                    <form action="{{ route('pumps.index') }}" method="GET">
                        @csrf
                        <input type="text" name="search" class="form-control w-56 box pr-10"
                            placeholder="Registration, Location">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </form>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto">
            @if ($message = Session::get('success'))
                <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2"
                    role="alert">
                    <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ $message }}
                    <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x"
                            class="w-4 h-4"></i>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table table-striped table-hover mt-2">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="">PUMP NAME</th>
                        <th class="text-center">PLANT NO</th>
                        <th class="text-center">REGISTRATION</th>
                        <th class="text-center">LOCATION</th>
                        <th class="text-center">YEAR</th>
                        <th class="text-center">MAKE</th>
                        <th class="text-center">MODEL</th>
                        <th class="text-center">CONCRETE PUMPED (OPENING BALANCE)</th>
                        <th class="text-center">SERIAL NO</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pumps as $pump)
                        <tr class="intro-x">
                            <td>{{ $pump->pump_name }}</td>
                            <td class="text-center">{{ $pump->plant_number }}</td>
                            <td class="text-center">{{ $pump->registration }}</td>
                            <td class="text-center">{{ $pump->location }}</td>
                            <td class="text-center">{{ $pump->year }}</td>
                            <td class="text-center">{{ $pump->pumpMake->make ?? 'No Make' }}</td>
                            <td class="text-center">{{ $pump->model }}</td>
                            <td class="text-center">{{ $pump->concrete_pumped_opening_balance }}</td>
                            <td class="text-center">{{ $pump->serial_no }}</td>
                            <td class="text-center">{{ $pump->status }}</td>
                            <td class="text-center">
                                <form action="{{ route('pumps.destroy', $pump->id) }}" method="POST">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('pumps.show', $pump->id) }}" class="btn btn-info mr-1 py-1 px-2">
                                            <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                            View</a>
                                        <a href="{{ route('pumps.edit', $pump->id) }}"
                                            class="btn btn-warning mr-1 py-1 px-2">
                                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger py-1 px-2 mr-1"
                                            onclick="return confirm('Are you sure?')"><i data-lucide="trash-2"
                                                class="w-4 h-4 mr-1"></i>Delete</button>

                                        <a href="{{ route('pumpHistory', ['pump_id' => $pump->id ?? 0]) }}"
                                            class="btn btn-primary mr-1 py-1 px-2" style="white-space: nowrap;">
                                            <i data-lucide="file-text" class="w-4 h-4 mr-1"></i>Pump History</a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" class="text-danger text-xl text-center">No Records Found </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {!! $pumps->links() !!}

        </div>
        <!-- END: Data List -->
    </div>
@endsection

@section('script')
    <Script>
        setTimeout(function() {
            $('#successAlert').remove();
        }, 4000);
    </Script>
@endsection

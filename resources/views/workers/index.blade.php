@extends('../layout/' . $layout)

@section('subhead')
    <title>All Workers | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">
        All Workers
    </h2>
    <div class="intro-y col-span-12 w-2/3">
        <form action="{{ route('workers.import') }}" method="POST" enctype="multipart/form-data" class="flex">
            @csrf
            <input type="file" name="file" class="form-control p-2 mr-6 w-56 " style="border:none;">
            <button type="submit" class="btn btn-outline-success w-auto mr-3">CSV Import</button>
            <a href="{{ route('workers.export', 'demo') }}" class="btn btn-outline-primary w-auto">Download Sample
                Import</a>
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
            <a href="{{ route('workers.create') }}" class="btn btn-primary shadow-md mr-2">Add New Worker</a>
            <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <a href="{{ route('workers.export', 'all') }}" class="btn btn-primary shadow-md mr-2">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Export to Excel
                </a>
                <div class="w-56 relative text-slate-500">
                    <form action="{{ route('workers.index') }}" method="GET">
                        @csrf
                        <input type="text" name="search" class="form-control w-56 box pr-10"
                            placeholder="Name, Contact Number">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </form>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            @if ($message = Session::get('success'))
                <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2"
                    role="alert">
                    <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ $message }}
                    <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x"
                            class="w-4 h-4"></i>
                    </button>
                </div>
            @endif
            <table class="table table-hover mt-2">
                <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="">NAME</th>
                        <th class="text-center">CONTACT NUMBER</th>
                        <th class="text-center">EMAIL</th>
                        <th class="text-center">DRIVING LICENSE</th>
                        <th class="text-center">HR LICENSE</th>
                        <th class="text-center">WHITE CARD</th>
                        <th class="text-center">ROLES</th>
                        <th class="text-center">PROJECTS INDUCTED</th>
                        <th class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($workers as $worker)
                        <tr class="intro-x">
                            <td>
                                {{ $worker->last_name }}, {{ $worker->first_name }}
                            @if($worker->status == 'Active')
                                <div class="text-green-500 text-xs whitespace-nowrap mt-0.5">
                                {{ $worker->status ?? '' }}</div>
                            @else
                                <div class="text-red-500 text-xs whitespace-nowrap mt-0.5">
                                {{ $worker->status ?? '' }}</div>
                            @endif
                            </td>
                            <td class="text-center">{{ $worker->contact_number }}</td>
                            <td class="text-center">{{ $worker->email }}</td>
                            <td class="text-center">{{ $worker->driving_license }}</td>
                            <td class="text-center">{{ $worker->hr_license }}</td>
                            <td class="text-center">{{ $worker->white_card }}</td>
                            {{-- <td class="text-center">{{ Carbon\Carbon::parse($worker->date_of_birth)->format('d-m-Y') }}</td> --}}
                            <td class="text-center">
                                @foreach ($worker->workerRoles as $key => $workerRole)
                                    {{ $workerRole->role_name }}
                                    @if ($key < $worker->workerRoles->count() - 1)
                                        ,
                                    @endif
                                @endforeach
                                @if ($worker->workerRoles->isEmpty())
                                    <span class="bg-red-500 text-white rounded px-2 ml-1">
                                        No Roles Selected</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @forelse ($worker->project as $project)
                                    <span
                                        class="bg-success/20 text-success rounded px-2 ml-1">{{ $project->project_name }}</span>
                                @empty
                                    <span class="bg-red-500 text-white rounded px-2 ml-1">
                                        No Project Inducted</span>
                                @endforelse
                            </td>
                            <td class="text-center">
                                <div class="flex justify-center items-center">
                                    <a data-tw-toggle="modal" data-tw-target="#view-worker-modal_{{ $worker->id }}"
                                        data-action="{{ route('workers.show', $worker->id) }}"
                                        class="btn btn-info mr-1 py-1 px-2">
                                        <i data-lucide="eye" class="w-4 h-4 mr-1"></i> View</a>

                                    <a href="{{ route('workers.edit', $worker->id) }}"
                                        class="btn btn-warning mr-1 py-1 px-2">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit</a>

                                    <a class="btn btn-danger py-1 px-2 mr-1" data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal_{{ $worker->id }}"
                                        data-action="{{ route('workers.destroy', $worker->id) }}">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                        Delete</a>
                                    <a href="{{ route('workerHistory', ['worker_id' => $worker->id ?? 0]) }}"
                                        class="btn btn-primary mr-1 py-1 px-2" style="white-space: nowrap;">
                                        <i data-lucide="file-text" class="w-4 h-4 mr-1"></i> Job History</a>
                                </div>
                                <!-- BEGIN: View Worker Modal -->
                                <div id="view-worker-modal_{{ $worker->id }}" class="modal" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="p-3 text-center">
                                                    <div class="text-3xl mt-5">Worker Details</div>
                                                    <div class="flex w-full">
                                                        <div class="w-1/2">
                                                            <table class="table table-report mt-5">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>First Name: </th>
                                                                        <td>
                                                                            <span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">
                                                                                {{ $worker->first_name }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Last Name: </th>
                                                                        <td>
                                                                            <span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">{{ $worker->last_name }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Email: </th>
                                                                        <td><span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">
                                                                                {{ $worker->email }}</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Contact Number: </th>
                                                                        <td>
                                                                            <span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">
                                                                                {{ $worker->contact_number }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Date of Birth: </th>
                                                                        <td><span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">
                                                                                {{ $worker->date_of_birth }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Roles: </th>
                                                                        <td>
                                                                            @foreach ($worker->workerRoles as $key => $workerRole)
                                                                                {{ $workerRole->role_name }}
                                                                                @if ($key < $worker->workerRoles->count() - 1)
                                                                                    ,
                                                                                @endif
                                                                            @endforeach
                                                                            @if ($worker->workerRoles->isEmpty())
                                                                                <span class="bg-red-500 text-white rounded px-2 ml-1">
                                                                                    No Roles Selected</span>
                                                                            @endif
                                                                           
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="w-1/2">
                                                            <table class="table table-report mt-5">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Driving License: </th>
                                                                        <td>
                                                                            <span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">
                                                                                {{ $worker->driving_license }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Driving License Expiry: </th>
                                                                        <td>
                                                                            <span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">
                                                                                {{ $worker->driving_license_expiry }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>HR License: </th>
                                                                        <td><span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">
                                                                                {{ $worker->hr_license }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>HR License Expiry: </th>
                                                                        <td><span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">
                                                                                {{ $worker->hr_license_expiry }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>White Card: </th>
                                                                        <td><span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">{{ $worker->white_card }}</span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <div class="w-full mt-5">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <th>Projects Inducted: </th>
                                                                    <td>
                                                                        @forelse ($worker->project as $project)
                                                                            <span
                                                                                class="bg-success/20 text-success rounded px-3 p-2 ml-1">
                                                                                {{ $project->project_name }}
                                                                            </span>
                                                                        @empty
                                                                        <span class="bg-red-500 text-white rounded px-2 ml-1">
                                                                            No Project Inducted</span>
                                                                        @endforelse
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                                <div class="px-5 pb-8 text-center mt-5">
                                                    <button type="button" data-tw-dismiss="modal"
                                                        class="btn btn-rounded btn-primary-soft w-24 mr-1">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: View Worker Modal -->
                                <!-- BEGIN: Delete Confirmation Modal -->
                                <div id="delete-confirmation-modal_{{ $worker->id }}" class="modal" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('workers.destroy', $worker->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body p-0">
                                                    <div class="p-5 text-center">
                                                        <i data-lucide="x-circle"
                                                            class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                                        <div class="text-3xl mt-5">Are you sure?</div>
                                                        <div class="text-slate-500 mt-2">
                                                            Do you really want to delete this record?
                                                            <br>
                                                            This process cannot be undone.
                                                        </div>
                                                    </div>
                                                    <div class="px-5 pb-8 text-center">
                                                        <button type="button" data-tw-dismiss="modal"
                                                            class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                                        <button type="submit" class="btn btn-danger w-24" close-modal
                                                            data-tw-dismiss="modal">Yes, Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Delete Confirmation Modal -->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-danger text-xl text-center">No Records Found </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {!! $workers->links() !!}
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

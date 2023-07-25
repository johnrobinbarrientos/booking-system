@extends('../layout/' . $layout)

@section('subhead')
    <title>All Project | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h1 class="intro-y text-lg font-medium mt-10">All Projects</h1>
    <div class="intro-y col-span-12 w-2/3 mt-3">
        <form action="{{ route('projects.import') }}" method="POST" enctype="multipart/form-data" class="flex">
            @csrf
            <input type="file" name="file" class="form-control p-2 mr-6 w-56 " style="border:none;">
            <button type="submit" class="btn btn-outline-success w-auto mr-3">CSV Import</button>
            <a href="{{ route('projects.export', 'demo') }}" class="btn btn-outline-primary w-auto">Download Sample
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
    <div class="grid grid-cols-12 gap-6 mt-10">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('projects.create') }}" class="btn btn-primary shadow-md mr-2">New Project</a>
            <a href="{{ route('projects.export', 'all') }}" class="btn btn-primary shadow-md mr-2">
                <i data-lucide="file-text" class="hidden sm:block w-4 h-4 mr-2"></i>
                Export to Excel
            </a>
            <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <form action="{{ route('projects.index') }}" method="GET">
                        @csrf
                        <input type="text" name="search" class="form-control w-56 box pr-10"
                            placeholder="Search Project Name ">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </form>
                </div>
            </div>
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            @if ($message = Session::get('success'))
                <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2"
                    role="alert">
                    <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ $message }}
                    <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x"
                            class="w-4 h-4"></i>
                    </button>
                </div>
            @endif
            <table class="table -mt-2 table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="text-center whitespace-nowrap">PROJECT NAME</th>
                        <th class="text-center whitespace-nowrap">ADDRESS</th>
                        <th class="text-center whitespace-nowrap">ORDER NUMBER</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr class="text-center">
                            <td>{{ $project->project_name }}</td>
                            <td class="text-center">
                                @forelse ($project->addresses as $address)
                                    <p class="text-sm">
                                        {{ $address->address }}
                                        {{ $address->suburb }}
                                        {{ $address->state }}
                                        {{ $address->postcode }}
                                    </p>
                                @empty
                                    <p class="text-sm text-danger">
                                        No addresses found for this project
                                    </p>
                                @endforelse
                            </td>
                            <td class="text-center"> {{ $project->project_order_number }}</td>
                            <td class="table-report__action w-56">
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('projects.edit', $project->id) }}"
                                            class="btn btn-warning mr-1 py-1 px-2">
                                            <i class="w-4 h-4 mr-1" data-lucide="check-square"></i>Edit</a>
                                        @hasanyrole('super admin|admin')
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger py-1 px-2"
                                            onclick="return confirm('Are you sure?')"><i data-lucide="trash-2"
                                                class="w-4 h-4 mr-1"></i>Delete</button>
                                        @endhasanyrole
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center text-xl">No Records Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $projects->links() }}
        </div>
    </div>
@endsection

@section('script')
    <Script>
        setTimeout(function() {
            $('#successAlert').remove();
        }, 4000);
    </Script>
@endsection

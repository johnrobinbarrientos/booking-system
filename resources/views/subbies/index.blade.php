@extends('../layout/' . $layout)

@section('subhead')
    <title>All Subbies | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">
        All Subbies
    </h2><br>
    <div class="intro-y col-span-12 w-2/3">
        <form action="{{route('subbies.import')}}" method="POST" enctype="multipart/form-data" class="flex">
            @csrf
            <input type="file" name="file" class="form-control p-2 mr-6 w-56 " style="border:none;">
            <button type="submit" class="btn btn-outline-success w-auto mr-3">CSV Import</button>
            <a href="{{route('subbies.export','demo')}}" class="btn btn-outline-primary w-auto">Download Sample Import</a>
        </form>
    </div>

    @if(isset($errors) && $errors->any())
    <p class="text-red-600">
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
    </p>
    @endif
    <!--@error('file')
        <p class="text-red-600">{{ $message }}</p>
    @enderror-->
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('subbies.create') }}" class="btn btn-primary shadow-md mr-2">Add New Subbie</a>
            <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <a href="{{ route('subbies.export','all') }}" class="btn btn-primary shadow-md mr-2">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Export to Excel
                </a>
                <div class="w-56 relative text-slate-500">
                    <form action="{{ route('subbies.index') }}" method="GET">
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
            <table class="table table-striped table-hover mt-2">
                <thead>
                    <tr>
                        <th class="text-center">Subbie Name</th>
                        <th class="text-center">CONTACT NUMBER</th>
                        <th class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subbies as $subbie)
                        <tr class="text-center">
                            <td class="text-center">{{ $subbie->name }}</td>
                            <td class="text-center"> {{ $subbie->contact_number }}</td>
                            <td class="table-report__action w-56">
                                <form action="{{ route('subbies.destroy', $subbie->id) }}" method="Post" enctype="multipart/form-data">
                                    <a href="{{ route('subbies.edit', $subbie->id) }}"
                                        class="btn btn-warning mr-1 py-1 px-2">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit</a>
                                    @hasanyrole('super admin|admin')
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger py-1 px-2"
                                        onclick="return confirm('Are you sure?')"><i data-lucide="trash-2"
                                            class="w-4 h-4 mr-1"></i>Delete</button>
                                    @endhasanyrole
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-danger text-center text-xl">No Records Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {!! $subbies->links() !!}
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

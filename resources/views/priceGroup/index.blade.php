@extends('../layout/' . $layout)

@section('subhead')
    <title>All Price Group | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">
        All Price Group
    </h2><br>
    @error('file')
        <p class="text-red-600">{{ $message }}</p>
    @enderror
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('price-groups.create') }}" class="btn btn-primary shadow-md mr-2">Add Price Group</a>
            <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <div class="w-56 relative text-slate-500">
                    <form action="{{ route('price-groups.index') }}" method="GET">
                         @csrf
                         <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Location Name" value="" >
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
            <table class="table table-report table-striped table-hover mt-2">
                <thead>
                    <tr>
                        <th class="">LOCATION NAME</th>
                        <th class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($priceGroups as $priceGroup)
                        <tr class="intro-x">
                            <td class="">{{ $priceGroup->location_name}}</td>
                            <td class="table-report__action">
                                <form action="{{ route('price-groups.destroy', $priceGroup->id) }}" method="POST">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('price-groups.edit', $priceGroup->id) }}" class="btn btn-warning text-white py-1 px-2 mr-1">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger py-1 px-2 btn-sm"
                                        onclick="return confirm('Are you sure?')"><i data-lucide="trash-2"
                                            class="w-4 h-4 mr-1"></i>Delete</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-danger text-xl text-center">No Records Found </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

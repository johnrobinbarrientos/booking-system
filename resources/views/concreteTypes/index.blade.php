@extends('../layout/' . $layout)

@section('subhead')
    <title>Job Types | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">
        Job Types
    </h2><br>
    <div class="intro-y col-span-12 w-2/3 mt-3">
        <form action="{{route('concreteTypes.import')}}" method="POST" enctype="multipart/form-data" class="flex">
            @csrf
            <input type="file" name="file" class="form-control p-2 mr-6 w-56 " style="border:none;">
            <button type="submit" class="btn btn-outline-success w-auto mr-3">CSV Import</button>
            <a href="{{route('concreteTypes.export','demo')}}" class="btn btn-outline-primary w-auto">Download Sample
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
            <a href="{{route('concreteTypes.create')}}" class="btn btn-primary shadow-md mr-2">Add New Job Type</a>
            <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <a href="{{route('concreteTypes.export','all')}}" class="btn btn-primary shadow-md mr-2">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Export to Excel
                </a>
                <div class="w-56 relative text-slate-500">
                    <form action="{{ route('concreteTypes.index') }}" method="GET">
                        @csrf
                        <input type="text" name="search" class="form-control w-56 box pr-10"
                            placeholder="Concrete Type">
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
                        <th class="text-center">JOB TYPE</th>
                        <th class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($concreteTypes as $concreteType)
                        <tr class="text-center">
                            <td class="text-center">{{ $concreteType->concrete_type }}</td>
                            <td class="table-report__action w-56">
                                <a href="{{route('concreteTypes.edit', $concreteType->id)}}" class="btn btn-warning mr-1 py-1 px-2">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit</a>
                                <a class="btn btn-danger py-1 px-2" data-tw-toggle="modal"
                                    data-tw-target="#delete-confirmation-modal_{{ $concreteType->id }}"
                                    data-action="{{ route('concreteTypes.destroy', $concreteType->id) }}">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                    Delete</a>

                                <!-- BEGIN: Delete Confirmation Modal -->
                                <div id="delete-confirmation-modal_{{ $concreteType->id }}" class="modal"
                                    tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST"
                                                action="{{ route('concreteTypes.destroy', $concreteType->id) }}">
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
                            <td colspan="2" class="text-danger text-center text-lg">No Records Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {!! $concreteTypes->links() !!}
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

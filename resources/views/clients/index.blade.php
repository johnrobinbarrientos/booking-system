@extends('../layout/' . $layout)

@section('subhead')
    <title>All Clients | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    @if ($message = Session::get('success'))
        <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2 mt-5"
            role="alert">
            <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ $message }}
            <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x"
                    class="w-4 h-4"></i>
            </button>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div id="successAlert" class="alert alert-danger-soft alert-dismissible show flex items-center mb-2 mt-5"
            role="alert">
            <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ $message }}
            <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x"
                    class="w-4 h-4"></i>
            </button>
        </div>
    @endif
    <h1 class="intro-y text-lg font-medium mt-10">All Clients</h1><br>
    <div class="intro-y col-span-12 w-2/3">
        <form action="{{ route('clients.import') }}" method="POST" enctype="multipart/form-data" class="flex">
            @csrf
            <input type="file" name="file" class="form-control p-2 mr-6 w-56 " style="border:none;">
            <button type="submit" class="btn btn-outline-success w-auto mr-3">CSV Import</button>
            <a href="{{route('clients.export','demo')}}" class="btn btn-outline-primary w-auto">Download Sample Import</a>
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
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <a href="{{ route('clients.create') }}" class="btn btn-primary shadow-md mr-2">Add New Client</a>
            <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <a href="{{ route('clients.export','all') }}" class="btn btn-primary shadow-md mr-2">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Export to Excel
                </a>
                <div class="w-56 relative text-slate-500">
                    <form action="{{ route('clients.index') }}" method="GET">
                        @csrf
                        <input type="text" name="search" class="form-control w-56 box pr-10"
                            placeholder="Search Name or ABN">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </form>
                </div>
            </div>
        </div>
        <!-- BEGIN: Users Layout -->
        @forelse ($clients as $client)
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 ">
                            <i data-lucide="user" class="w-12 h-12 ml-0.5 inline-block align-middle"></i>
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium"> {{ $client->name }}</a>
                            <div class="text-slate-500 text-xs mt-0.5">{{ $client->abn }}</div>
                        </div>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                            <div class="flex mt-4 lg:mt-0">
                                <a href="{{ route('clients.show', $client->id) }}"
                                    class="btn btn-info btn-sm py-1 px-2 mr-1">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i>View</a>
                                <a href="{{ route('clients.edit', $client->id) }}"
                                    class="btn btn-warning btn-sm flex items-center mr-1">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit</a>
                                @hasanyrole('super admin|admin')
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger py-1 px-2 btn-sm mr-1"
                                    onclick="return confirm('Are you sure?')"><i data-lucide="trash-2"
                                        class="w-4 h-4 mr-1"></i>Delete</button>
                                @endhasanyrole
                                <a href="{{ route('clientJobs', ['client_id' => $client->id ?? 0]) }}" class="btn btn-primary shadow-md">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    Client Jobs
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @empty
            <span class="intro-y col-span-12 text-red-600 text-center text-xl">No Records Found</span>
        @endforelse
    </div>
    <div class="mt-3">
        {!! $clients->links() !!}
    </div>
@endsection

@section('script')
    <Script>
        setTimeout(function() {
            $('#successAlert').remove();
        }, 4000);
    </Script>
@endsection

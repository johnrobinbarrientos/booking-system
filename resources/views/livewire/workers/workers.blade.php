<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href="{{ route('workers.create') }}" class="btn btn-primary shadow-md mr-2">Add New Worker</a>
        <div class="dropdown">
            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
            </button>
            <div class="dropdown-menu w-40">
                <ul class="dropdown-content">
                    <li>
                        <a href="" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                            Print </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                            Export to Excel </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                            Export to PDF </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="hidden md:block mx-auto text-slate-500"></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-slate-500">
                <input type="text" wire:model="search" class="form-control w-56 box pr-10" placeholder="Search...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
            </div>
        </div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        @if (session('status'))
            <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2"
                role="alert">
                <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ session('status') }}
                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x"
                        class="w-4 h-4"></i>
                </button>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2"
                role="alert">
                <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ $message }}
                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x"
                        class="w-4 h-4"></i>
                </button>
            </div>
        @endif
        <table class="table table-report table-hover mt-2">
            <thead>
                <tr class="text-center">
                    <th class="text-center">WORKER NAME</th>
                    <th class="text-center">CONTACT NUMBER</th>
                    <th class="text-center">EMAIL</th>
                    <th class="text-center">DATE OF BIRTH</th>
                    <th class="text-center">ROLES</th>
                    <th class="text-center">SITES INDUCTED</th>
                    <th class="text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($workers as $worker)
                    <tr class="intro-x">
                        <td>{{ $worker->name }}</td>
                        <td class="text-center">{{ $worker->contact_number }}</td>
                        <td class="text-center">{{ $worker->email }}</td>
                        <td class="text-center">{{ Carbon\Carbon::parse($worker->date_of_birth)->format('d-m-Y') }}</td>
                        <td class="text-center">{{ $worker->roles }}</td>
                        <td class="text-center">{{$worker->project->project_name ?? ''}}</td>
                        <td class="text-center">
                            <div class="flex justify-center items-center">
                                <a href="" class="btn btn-info btn-sm mr-3"><i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                     View</a>
                                <a class="btn btn-warning btn-sm  mr-3" href="#"> 
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>Edit </a>
                                <a onclick="return confirm('Are you sure?') || event.stopImmediatePropagation()"
                                    href="#" wire:click="deleteWorker('{{ $worker->id }}')"
                                    class="btn btn-danger btn-sm">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-danger text-xl text-center">No Records Found </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
</div>

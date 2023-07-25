@extends('../layout/' . $layout)

@section('subhead')
    <title>Users Accounts | Rowland Contractors | Pump Booking System</title>
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

    <h1 class="intro-y text-lg font-medium mt-10">All Users</h1>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <a href="{{ route('users.create') }}" class="btn btn-primary shadow-md mr-2">
                Add New User
            </a>
            <div class="hidden xl:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <form action="{{ route('users.index') }}" method="GET">
                    @csrf
                    <input type="text" name="search" class="form-control w-56 box pr-10"
                        placeholder="Search Name or Email">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </form>
            </div>
        </div>
        @forelse ($users as $user)
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 ">
                            <i data-lucide="user" class="w-12 h-12 ml-0.5 inline-block align-middle"></i>
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium"> {{ $user->name }}</a>
                            <div class="text-slate-500 text-xs mt-0.5">{{ $user->email }}</div>
                            <div class="text-slate-500 text-xs mt-0.5">{{ $user->role_type }}</div>
                        </div>
                        <div class="flex mt-4 lg:mt-0">
                            <a href="{{ route('resetPassword', $user->id) }}"
                                class="btn-sm box flex items-center text-primary dark:text-slate-300 border border-primary mr-1">
                                Reset Password
                            </a>
                            <a href="#" class="btn-sm box flex items-center text-primary dark:text-slate-300 border border-primary mr-1" data-tw-toggle="modal"
                                data-tw-target="#disable2fa-confirmation-modal_{{ $user->id }}"
                                data-action="{{ route('disable2fa', $user->id) }}">
                                Disable 2fa</a>
                                
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="btn btn-warning btn-sm flex items-center mr-1">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit</a>
                            <a class="btn btn-danger py-1 px-2" data-tw-toggle="modal"
                                data-tw-target="#delete-confirmation-modal_{{ $user->id }}"
                                data-action="{{ route('users.destroy', $user->id) }}">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                Delete</a>
                        </div>
                        <!-- BEGIN: Delete Confirmation Modal -->
                        <div id="delete-confirmation-modal_{{ $user->id }}" class="modal" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body p-0">
                                            <div class="p-5 text-center">
                                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
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

                        <!-- Disable 2fa-->
                        <div id="disable2fa-confirmation-modal_{{ $user->id }}" class="modal" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('disable2fa', $user->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body p-0">
                                            <div class="p-5 text-center">
                                                <div class="text-3xl mt-5">Are you sure?</div>
                                                <div class="text-slate-500 mt-2">
                                                    Do you really want to disable 2fa on this record?
                                                </div>
                                            </div>
                                            <div class="px-5 pb-8 text-center">
                                                <button type="button" data-tw-dismiss="modal"
                                                    class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                                <button type="submit" class="btn btn-primary w-36" close-modal
                                                    data-tw-dismiss="modal" >Yes, Proceed</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <span class="intro-y col-span-12 text-red-600 text-center text-xl">No Records Found</span>
        @endforelse
    </div>

    <div class="mt-3">
        {!! $users->links() !!}
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">

     setTimeout(function() {
         $('#successAlert').remove();
     }, 4000);


    </script>
@endsection

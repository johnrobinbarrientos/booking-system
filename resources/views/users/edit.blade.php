@extends('../layout/' . $layout)

@section('subhead')
    <title>New User | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Update User</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12 2xl:col-span-12">
            <form action="{{route('users.update', $user->id)}}" method="POST"  class="w-full">
                @csrf
                @method('PUT')
                <div class="intro-y box p-5">
                    <div class="p-5">
                        <fieldset class="flex w-full">
                            <div class="w-1/2 mr-4">
                                <h2 class="text-xl text-primary">User Details</h2>
                                <div class="flex flex-col pt-4">
                                        <label style="padding-bottom:10px;">Role</label>
                                        <div class="flex-col w-1/2 ">
                                            <input id="role_type" type="radio" name="role_type" value="admin" class="form-check-input" {{ $user->role_type == 'admin' ? 'checked' : '' }}>
                                            <label for="admin-role" style="padding-right:30px;">Admin</label>
                                            
                                            <input id="role_type" type="radio" name="role_type" value="user" class="form-check-input" {{ $user->role_type == 'user' ? 'checked' : '' }}>
                                            <label for="user-role">User</label>
                                        </div>
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Name </label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{$user->email}}">
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row gap-2 mt-5">
                    <a href="{{route('users.index')}}"
                        class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                    <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">

    </script>
@endsection


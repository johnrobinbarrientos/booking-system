@extends('../layout/' . $layout)

@section('subhead')
    <title>New User | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Reset Password</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12 2xl:col-span-12">
            <form action="{{route('saveResetPassword', $user->id)}}" method="POST"  class="w-full">
                @csrf
                @method('PUT')
                <div class="intro-y box p-5">
                    <div class="p-5">
                        <fieldset class="flex w-full">
                            <div class="w-1/2 mr-4">
                                <h2 class="text-xl text-primary">User Details</h2>
                                <div class="flex flex-col pt-4">
                                    <label for="">Name </label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}" readonly>
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{$user->email}}" readonly>
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                <div class="relative mt-2 col-span-4">
                                    <label for="">Password
                                        <input type="text" name="password" id="password" value="{{ old('password') }}"
                                            class="form-control">
                                    </label>

                                    @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <button onclick="generatePassword()" type="button"
                                        class="h-full inline-flex items-center px-4 py-2 btn btn-dark">Generate
                                        Password</button>

                                    <button data-tw-toggle="modal" data-tw-target="#success-modal-preview"
                                        onclick="copyPassword()" type="button"
                                        class="h-full inline-flex items-center px-4 py-2 btn btn-outline-success copy-button">
                                        Copy</button>
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
    <script>
        function generatePassword() {
            var pass = '';
            var str = '?!&^%ABCDEFGHIJKLMNOPQRSTUVWXYZ' +
                'abcdefghijklmnopqrstuvwxyz0123456789@#$';

            for (let i = 1; i <= 15; i++) {
                var char = Math.floor(Math.random() * str.length + 1);
                pass += str.charAt(char)
            }
            $('#password').val(pass);
        }

        function copyPassword() {
            var copyText = document.getElementById("password");
            copyText.select();
            //copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            //alert("Password Copied");
        }
    </script>
@endsection


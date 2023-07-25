@extends('../layout/base')

@section('head')
    <title>2FA - Rowland</title>
@endsection

@section('body')

    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <div class="my-auto">
                        <a href="" class="-intro-x flex items-start pt-5">
                            <span class="text-white text-4xl mr-10 mt-5">
                                Rowland Contractors Booking
                            </span>
                        </a>
                        <img alt="" class="-intro-x w-1/2 mt-10"
                            src="{{ asset('build/assets/images/rowland-logo.png') }}">
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400"></div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div
                        class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Please enter the code
                            from your authenticator application. </h2>
                        <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">Rowland Contractors Booking.</div>
                        <div class="intro-x mt-8">
                            @if (session('error'))
                                <div class="alert alert-danger-soft show flex items-center mb-2" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('two-factor-auth.confirm') }}">
                                @csrf
                                <input type="hidden" name="action" value="challenge">
                                <label for="">2FA Code</label>
                                <input type="text"
                                    class="intro-x login__input form-control py-3 px-4 block mt-1 @error('code') is-invalid @enderror"
                                    name="code" autocomplete="current-code">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                    <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top"
                                        type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>


        <!-- BEGIN: JS Assets-->
        @vite('resources/js/app.js')
        <!-- END: JS Assets-->

        @yield('script')
    </body>
@endsection

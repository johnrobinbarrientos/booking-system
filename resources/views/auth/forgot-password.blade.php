@extends('../layout/' . $layout)

@section('head')
    <title>Forgot Password - Rowland Contractors Booking</title>
@endsection

@section('content')
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
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Forgotten Password</h2>
                    <div class="intro-x mt-2 text-slate-400">To reset your password, please enter the email Address for your
                        account below.</div>
                    <div class="intro-x mt-8">
                        <form method="POST" action="{{route('password.email')}}">
                         @csrf
                         @if(session('status'))
                         <div class="alert alert-success-soft show flex items-center mb-2" role="alert">
                              {{session('status')}}
                         </div>
                         @endif
                            <input type="email" name="email" class="intro-x form-control py-3 px-4 block"
                                placeholder="Email" required>
                            @if ($errors->has('email'))
                                <p class="text-red-500 ">{{ $errors->first('email') }}
                                </p>
                            @endif
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit"
                            class="btn btn-primary py-3 px-4 w-full xl:w-40 xl:mr-3 align-top">Send Password Link</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
@endsection
@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard</title>
@endsection

@section('subcontent')
    <!-- BEGIN: Content -->
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Account
            </h2>
        </div>
        <!-- BEGIN: Profile Info -->
        <div class="intro-y box px-5 pt-5 mt-5">
            <ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist">
                <li id="profile-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="nav-link py-4 flex items-center active" data-tw-target="#profile"
                        aria-controls="profile" aria-selected="true" role="tab"> <i class="w-4 h-4 mr-2"
                            data-lucide="user"></i> General Information </a>
                </li>
                <li id="account-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="nav-link py-4 flex items-center" data-tw-target="#account"
                        aria-selected="false" role="tab"> <i class="w-4 h-4 mr-2" data-lucide="pencil"></i> Update Info
                    </a>
                </li>
                <li id="change-password-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="nav-link py-4 flex items-center" data-tw-target="#change-password"
                        aria-selected="false" role="tab"> <i class="w-4 h-4 mr-2" data-lucide="lock"></i> Change
                        Password </a>
                </li>
            </ul>
        </div>
        <!-- END: Profile Info -->
        <div class="tab-content mt-5">
            <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 2xl:col-span-8">
                        <!-- BEGIN: Profile Information -->
                        <div class="intro-y box ">
                            <div
                                class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">
                                    Profile Information
                                </h2>
                            </div>
                            <div class="p-5">
                                @if (session('status'))
                                <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2" role="alert">
                                    <i data-lucide="check" class="w-6 h-6 mr-2"></i> {{ session('status') }}
                                    <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x"
                                            class="w-4 h-4"></i>
                                    </button>
                                </div>
                                @endif 

                            
                                <div class="overflow-x-auto">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="border">Name</th>
                                                <td class="border">{{ $user->name }}</td>
                                            </tr>

                                            <tr>
                                                <th class="border">E-mail Address</th>
                                                <td class="border">{{ $user->email }}</td>
                                            </tr>

                                            <tr>
                                                <th class="border">Account Created</th>
                                                <td class="border">{{ $user->created_at->toDayDateTimeString() }}</td>
                                            </tr>

                                            <tr>
                                                <th class="border">Last Updated</th>
                                                <td class="border">{{ $user->updated_at->toDayDateTimeString() }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th class="border">Two Factor Autentication</th>
                                                <td class="border">
                                                    @if (auth()->user()->two_factor_confirmed)
                                                        <form action="/user/two-factor-authentication" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <!-- <button type="submit">Disable 2FA</button> -->
                                                            <button class="btn btn-danger mt-5" type="submit"><i
                                                                    data-lucide="shield-off" class="mr-2"></i> Disable
                                                                2FA</button>
                                                        </form>
                                                        <!-- 2FA enabled but not yet confirmed, we show the QRcode and ask for confirmation : -->
                                                    @elseif(auth()->user()->two_factor_secret)
                                                        <p class="text-danger font-bold leading-none">Please scan the QR code from your authenticator application and validate code.
                                                            Otherwise you won't be able to log in to the system. </p> <br>
                                                        <!-- <p>Validate 2FA by scanning the floowing QRcode and entering the TOTP</p> -->
                                                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                                        <form action="{{ route('two-factor-auth.confirm') }}" class="form-inline"
                                                            method="post">
                                                            @csrf
                                                            <!-- <input name="code" required/> -->
                                                            <div class="form-group mt-3">
                                                                <input type="text" name="code" class="form-control"
                                                                    placeholder="Enter code">
                                                                @if ($errors->has('name'))
                                                                    <span
                                                                        class="text-danger">{{ $errors->first('code') }}</span>
                                                                @endif
                                                                <!-- <button type="submit">Validate 2FA</button> -->
                                                                <button class="btn btn-primary mt-3" type="submit"><i
                                                                        data-lucide="shield" class="mr-2"></i> Validate
                                                                    2FA</button>
                                                            </div>

                                                        </form>

                                            {{-- <p class="text-danger font-bold leading-none mt-5">
                                                P.S. - Store these recovery so that it can be used to recover access to your account if your two factor authentication device is lost.
                                            </p> --}}

                                            {{-- <div class="mt-10">
                                                <h3 class="text-2xl">Recovery Codes:</h3>
                                                <ul>
                                                    @foreach ( json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                                        <li class="p-1">{{$code}} </li>
                                                    @endforeach
                                                </ul>
                                            </div> --}}
                                </div>
                                <!-- 2FA not enabled at all, we show an 'enable' button  : -->
                                <!-- 2FA not enabled at all, we show an 'enable' button  : -->
                            @else
                                <form action="/user/two-factor-authentication" method="post">
                                    @csrf
                                    <!-- <button type="submit">Activate 2FA</button> -->
                                    <button class="btn btn-primary" type="submit"><i data-lucide="shield"
                                            class="mr-2"></i> Activate 2FA
                                    </button>
                                </form>
                                @endif
                                </td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END: Latest Uploads -->
                </div>
            </div>
        </div>
        <!--Begin: Update information -->

        <div id="account" class="tab-pane" role="tabpanel" aria-labelledby="information-tab">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 2xl:col-span-8">
                    <div class="intro-y box">
                        <div class="flex items-center px-5 py-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Edit Information
                            </h2>
                        </div>
                        <div class="p-5">
                            @livewire('update-profile')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End: Update information -->
        <!--Begin: Change Password -->
        <div id="change-password" class="tab-pane" role="tabpanel" aria-labelledby="password-tab">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 2xl:col-span-8">
                    <div class="intro-y box">
                        <div class="flex items-center px-5 py-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Change Password
                            </h2>
                        </div>
                        <div class="p-5">
                            @livewire('change-password')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End: Change Password -->
    </div>

    </div>
    <!-- END: Content -->
@endsection

@section('script')
    <Script>
        setTimeout(function() {
            $('#successAlert').remove();
        }, 4000);
    </Script>
@endsection

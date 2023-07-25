@extends('../layout/' . $layout)

@section('subhead')
    <title>Verify Email</title>
@endsection

@section('subcontent')
    <!-- BEGIN: Content -->
    <div class="content">
        <div class="intro-y grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 lg:col-span-12">
                <!-- BEGIN: Soft Color Alert -->
                <div class="intro-y box mt-5">
                    <div
                        class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            Verify Email Address
                        </h2>
                    </div>
                    <div id="softcolor-alert" class="p-5">
                        @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success-soft show flex items-center mb-2" role="alert">
                            <i data-lucide="send" class="w-6 h-6 mr-2"></i>
                            A new email verification link has been emailed to you!
                        </div>
                        @endif
                        <div class="preview">
                            <div class="alert alert-pending-soft show flex items-center mb-2" role="alert">
                                <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i>
                                Before proceeding, please check your email for a verification link. If you did not receive
                            </div>
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary mt-5">Click here to request another</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END: Soft Color Alert -->
            </div>
        </div>
    </div>
    <!-- END: Content -->
@endsection

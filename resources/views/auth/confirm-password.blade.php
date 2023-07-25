@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard</title>
@endsection

@section('subcontent')
    <!-- BEGIN: Content -->
    <div class="content">
     <div class="grid grid-cols-12 gap-6">
         <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
             <!-- BEGIN: Change Password -->
             <div class="intro-y box lg:mt-5">
                 <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                     <h2 class="font-medium text-base mr-auto">
                         Password Confirmation
                     </h2>
                 </div>
                 <div class="p-5">
               <form method="POST" action="{{route('password.confirm')}}">
                    @csrf
                     <div class="mt-3">
                         <label for="" class="form-label">Please confirm your password before continuing.</label>
                         <input name="password" type="password" class="form-control" placeholder="Password">
                     </div>
                     <button type="submit" class="btn btn-primary mt-4">Confirm</button>
               </form>
                 </div>
             </div>
             <!-- END: Change Password -->
         </div>
     </div>
 </div>
 <!-- END: Content -->
@endsection

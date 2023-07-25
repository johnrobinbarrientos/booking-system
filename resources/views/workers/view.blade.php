@extends('../layout/' . $layout)

@section('subhead')
    <title>Worker Details | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Worker Details</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12 2xl:col-span-12">
                <div class="intro-y box p-5">
                    <div class="p-5">
                        <div class="w-full flex">
                            <fieldset class="w-1/2 mr-6">
                                <h3 class="text-xl text-primary">Worker Details</h3>
                                <div class="flex flex-col pt-4">
                                    <label for="">First Name</label>
                                    <input type="text" name="first_name" value="{{$worker->first_name}}" class="form-control">
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Last Name</label>
                                    <input type="text" name="last_name" value="{{$worker->last_name}}" class="form-control">
                                    
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Worker Contact Number</label>
                                    <input type="text" name="contact_number" value="{{$worker->contact_number}}"  class="form-control">
                                    
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Worker Email Address</label>
                                    <input name="email" type="text" value="{{$worker->email}}"  class="form-control">
                                    
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Date Of Birth</label>
                                    <input name="date_of_birth" value="{{$worker->date_of_birth}}"  class="form-control" type="text">
                                    
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Driving License</label>
                                    <input name="driving_license" value="{{$worker->driving_license}}"  class="form-control" type="text">
                                    
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Driving License Expiry</label>
                                    <input name="driving_license_expiry" value="{{$worker->driving_license_expiry}}"  class="form-control" type="text">
                                    
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">HR License</label>
                                    <input name="hr_license" value="{{$worker->hr_license}}"  class="form-control" type="text">
                                    
                                </div>
                            </fieldset>
                            <fieldset class="w-1/2 mt-7">
                                <div class="flex flex-col pt-4">
                                    <label for="">HR License Expiry</label>
                                    <input name="hr_license_expiry" value="{{$worker->hr_license_expiry}}"  class="form-control" type="text">
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">White Card</label>
                                    <input name="white_card" value="{{$worker->white_card}}"  class="form-control" type="text">
                                </div>
                                <h3 class="text-lg text-primary pt-4">Worker Roles</h3>
                                <div class="flex flex-col pt-4">
                                    <label for="">Worker Roles</label>
                                    <input type="text" class="form-control" value={{$worker->roles}}>
                                    
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Site Inducted</label>
                                </div>
                                <h2 class="text-xl text-primary mt-3">Emergency Contact Details</h2>
                                <div class="flex flex-col pt-4">
                                    <label for="">Emergency Contact Name</label>
                                    <input name="emergency_contact_name" type="text" value="{{$worker->emergency_contact_name}}"  class="form-control">
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Emergency Contact Number</label>
                                    <input name="emergency_contact_number" type="text" value="{{$worker->emergency_contact_number}}" class="form-control">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                    <a href="{{ route('workers.index') }}"
                        class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Back to Workers</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    const formElements = document.querySelectorAll('input, select, textarea');
    formElements.forEach(element => {
        element.style.border = 'none';
    });
</script>
@endsection

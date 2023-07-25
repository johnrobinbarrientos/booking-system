@extends('../layout/' . $layout)

@section('subhead')
    <title>Update Worker | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Update Worker</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12 2xl:col-span-12">
          <form action="{{route('workers.update', $worker->id)}}" method="POST" class="w-full">
               @csrf
               @method('PUT')
                <div class="intro-y box p-5">
                    <div class="p-5">
                        <div class="w-full flex">
                            <fieldset class="w-1/2 pt-4 mr-6">
                                <h2 class="text-xl text-primary">Worker Details</h2>
                                <div class="flex flex-col pt-4">
                                    <label for="">First Name *</label>
                                    <input type="text" name="first_name" value="{{$worker->first_name}}" class="form-control">
                                    @error('first_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Last Name *</label>
                                    <input type="text" name="last_name" value="{{$worker->last_name}}" class="form-control">
                                    @error('last_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="" class="form-label">Worker Contact Number *
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500 text-success">e.g, 0469309713 or +61469309713  </span>
                                    </label>
                                    <input type="text" name="contact_number" value="{{$worker->contact_number}}"  class="form-control">
                                    @error('contact_number')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Worker Email Address *</label>
                                    <input name="email" type="text" value="{{$worker->email}}"  class="form-control">
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Date Of Birth *</label>
                                    <input name="date_of_birth" value="{{$worker->date_of_birth}}"  class="form-control" type="date">
                                    @error('date_of_birth')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Driving License</label>
                                    <input name="driving_license" value="{{$worker->driving_license}}"  class="form-control" type="text">
                                    @error('driving_license')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">Driving License Expiry</label>
                                    <input name="driving_license_expiry" value="{{$worker->driving_license_expiry}}"  class="form-control" type="date">
                                    @error('driving_license_expiry')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">HR License</label>
                                    <input name="hr_license" value="{{$worker->hr_license}}"  class="form-control" type="text">
                                    @error('hr_license')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">HR License Expiry</label>
                                    <input name="hr_license_expiry" value="{{$worker->hr_license_expiry}}"  class="form-control" type="date">
                                    @error('hr_license_expiry')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="">White Card</label>
                                    <input name="white_card" value="{{$worker->white_card}}"  class="form-control" type="text">
                                    @error('white_card')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </fieldset>
                            <fieldset class="w-1/2 pt-4">
                                <div class="flex flex-col pt-4">
                                    <label for="">Start Date</label>
                                    <input name="start_date" value="{{$worker->start_date}}"  class="form-control" type="date">
                                    @error('start_date')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="flex flex-col pt-4">
                                    <label for="">Finish Date</label>
                                    <input name="finish_date" value="{{$worker->finish_date}}"  class="form-control" type="date">
                                    @error('finish_date')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Status</span>
                                            <select name="status" id="status"class="form-control" required="required">
                                                <option value="Active" {{ $worker->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive"{{ $worker->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                    </label>
                                    @error('status')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="flex flex-col pt-4">
                                    <label for="">
                                        <span class="text-gray-700">Employment Type</span>
                                            <select name="employment_type" class="form-control" required="required">
                                                <option value="Full Time" {{ $worker->employment_type == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                                <option value="Part Time"{{ $worker->employment_type == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                                <option value="Casual"{{ $worker->employment_type == 'Casual' ? 'selected' : '' }}>Casual</option>
                                            </select>
                                    </label>
                                    @error('employment_type')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <h3 class="text-lg text-primary pt-4">Worker Roles</h3>
                                <div class="flex flex-row pt-4">
                                    <div class="form-check inline-flex mr-4">
                                        <input id="checkbox-switch-2" name="Operator" class="form-check-input" value="1" type="checkbox" {{ $worker->workerRoles->contains(1) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkbox-switch-2">Operator</label>
                                    </div>
                                    <div class="form-check inline-flex mr-4">
                                        <input id="checkbox-switch-3" name="Hoseman" class="form-check-input" value="1" type="checkbox" {{ $worker->workerRoles->contains(2) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkbox-switch-3">Hoseman</label>
                                    </div>
                                    <div class="form-check inline-flex">
                                        <input id="checkbox-switch-4" name="Extraman" class="form-check-input" value="1" type="checkbox" {{ $worker->workerRoles->contains(3) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkbox-switch-4">Extraman</label>
                                    </div>
                                </div>
                                {{-- <div class="flex flex-col pt-4">
                                    <label for="">Worker Roles</label>
                                    <select name="worker_role_id[]" data-placeholder="Select Roles" class="tom-select w-full" multiple>
                                        @foreach ($workerRoles as $workerRole)
                                            <option value="{{ $workerRole->id }}" @if($worker->workerRoles->contains('id', $workerRole->id)) selected @endif>{{ $workerRole->role_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('worker_role_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                
                                <div class="flex flex-col pt-4 mt-2">
                                    <label for="">Projects Inducted</label>
                                    <?php $selected_projects = $worker->project->pluck('id'); ?>
                                    <select name="project_id[]" data-placeholder="Search a Project" class="tom-select w-full" multiple>
                                        @foreach ($worker->project as $project)
                                            <option value="{{ $project->id }}" selected>{{ $project->project_name }}</option>
                                        @endforeach
                                        @foreach ($projects->diff($worker->project) as $project)
                                            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                        @endforeach
                                    </select>  
                                </div>
                                <h2 class="text-xl text-primary mt-3">Emergency Contact Details</h2>
                                <div class="flex flex-col pt-4">
                                    <label for="">Emergency Contact Name *</label>
                                    <input name="emergency_contact_name" type="text" value="{{$worker->emergency_contact_name}}"  class="form-control">
                                    @error('emergency_contact_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="" class="form-label">Worker Emergency Contact Number * 
                                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500 text-success">e.g, 0469309713 or +61469309713  </span>
                                    </label>
                                    <input name="emergency_contact_number" type="text" value="{{$worker->emergency_contact_number}}" class="form-control">
                                    @error('emergency_contact_number')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4 mt-2">
                                    <label for="">Notes</label>
                                    <textarea name="notes" id="notes" cols="30" rows="10" class="form-control w-full h-20">{{ $worker->notes ?? '' }}</textarea>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                    <a href="{{ route('workers.index') }}"
                        class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                    <button type="submit" class="btn btn-primary py-3 border-slate-300 w-full md:w-52">Update
                        Worker</button>
                </div>
            </form>
        </div>
    </div>

    <div id="check_worker_modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <div class="text-3xl mt-5">This worker have existing bookings</div>
                        <table id="bookingTable" class="table table-striped table-bordered table-responsive 2xl:mt-2">
                            <thead>
                                <tr>
                                    <th>Booking Number</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="text-slate-500 mt-2">
                            Do you wish to proceed?
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button  id="cancelButton" data-tw-dismiss="modal"
                            class="btn btn-danger w-24 mr-1 btn-cancel" onclick="setWorkerActive();">Cancel</button>
                        <button type="submit" id="confirmButton" class="btn btn-primary btn-credit-submit w-36"
                            close-modal data-tw-dismiss="modal">Yes, Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        document.querySelector("input[name='hr_license_expiry']").min = new Date().toISOString().split("T")[0];
        document.querySelector("input[name='driving_license_expiry']").min = new Date().toISOString().split("T")[0];

        var worker = {!! $worker->toJson() !!};

        jQuery("#status").on("change", function() {
            if ($("#status").val() == "Inactive"){
                checkBookingWorker()
            }
        });

        function checkBookingWorker(){
            
            var workerId = worker.id
            
            jQuery.ajax({
                url: '/checkBookingWorker/' + workerId,
                method: 'get',
                async: false,
                success: function(response) {
                    if (response.total_count > 0){
                        const el = document.querySelector("#check_worker_modal");
                        const modal = tailwind.Modal.getOrCreateInstance(el);
                        modal.show();
                        
                        jQuery("#bookingTable tbody").empty();

                        response.booking_list.forEach(function (item, index) {
                            jQuery("#bookingTable tbody").append("<tr>" +
                                "<td>" + item + "</td>" +
                                "</tr>")
                            })
                            
                    }
                }
            });
        }

        function setWorkerActive(){
            $("#status").val("Active")
        }

    </script>
@endsection

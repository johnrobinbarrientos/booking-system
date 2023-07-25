<form wire:submit.prevent="save" method="POST" class="w-full">
    <div class="intro-y box p-5">
        <div class="p-5">
            <div class="w-full flex">
                <fieldset class="w-1/2 pt-4 mr-6">
                    <h2 class="text-xl text-primary">Worker Details</h2>
                    <div class="flex flex-col pt-4">
                        <label for="">Worker Name</label>
                        <input wire:model="worker.name" type="text">
                        @error('worker.name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="flex flex-col pt-4">
                        <label for="">Worker Contact Number</label>
                        <input type="text" wire:model="worker.contact_number">
                        @error('worker.contact_number')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="flex flex-col pt-4">
                        <label for="">Worker Email Address</label>
                        <input wire:model="worker.email" type="text">
                        @error('worker.email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="flex flex-col pt-4">
                        <label for="">Date Of Birth</label>
                        <input wire:model="worker.date_of_birth" type="date">
                        @error('worker.date_of_birth')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <h3 class="text-lg text-primary pt-4">Worker Roles</h3>
                    <div class="flex flex-col pt-4">
                        <label for="">Worker Roles</label>
                        <select wire:model="worker.roles"  name="worker.roles" id="">
                            <option>Select Roles</option>
                            <option value="Operator">Operator</option>
                            <option value="Hoseman">Hoseman</option>
                            <option value="Extraman">Extraman</option>
                        </select>
                        @error('worker.roles')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                       
                    </div>
                    <div class="flex flex-col pt-4">
                        <label for="">Sites Inducted</label>
                        <select wire:model="worker.project_id" name="worker.project_id">
                            <option value="" disabled selected>-- choose a site --</option>
                            @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->project_name}}</option>
                            @endforeach
                        </select>
                        @error('worker.project_id')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="mt-4 bg-slate-100 p-2">
                            <h3 class="text-lg text-primary">Site list</h3>
                            <ul>
                                <li>Site Name</li>
                            </ul>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="w-1/2 pt-4">
                    <h2 class="text-xl text-primary">Emergency Contact Details</h2>
                    <div class="flex flex-col pt-4">
                        <label for="">Emergency Contact Name</label>
                        <input wire:model="worker.emergency_contact_name" type="text">
                        @error('worker.emergency_contact_name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="flex flex-col pt-4">
                        <label for="">Emergency Contact Number</label>
                        <input wire:model="worker.emergency_contact_number" type="text">
                        @error('worker.emergency_contact_number')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <!-- END: Uplaod Product -->
    <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
        <a href="{{route('workers.index')}}"
            class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
        <button type="submit" class="btn btn-primary py-3 border-slate-300 w-full md:w-52">Save & Add New
            Worker</button>
    </div>
</form>
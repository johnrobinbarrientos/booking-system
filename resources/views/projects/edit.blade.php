@extends('../layout/' . $layout)

@section('subhead')
    <title>Edit Project | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Edit Project</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
     <div class="intro-y col-span-12 2xl:col-span-12">
        <form action="{{route('projects.update', $project->id)}}" method="POST"  class="w-full">
            @csrf
            @method('PUT')
            <div class="intro-y box p-5">
                <div class="p-5">
                    <fieldset class="flex w-full">
                        <div class="w-1/2 mr-4">
                            <h2 class="text-xl text-primary">Project Details</h2>
                            <div class="flex flex-col pt-4">
                                <label for="">Project Name *</label>
                                <input type="text" name="project_name" class="form-control" value="{{$project->project_name}}">
                                @error('project_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="flex flex-col pt-4">
                                <label for="">Project Order Number *</label>
                                <input type="text" name="project_order_number" class="form-control" value="{{$project->project_order_number}}">
                                @error('project_order_number')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <input type="hidden" class="form-control" name="project_id"
                                        value="{{ $project->id }}" />
                            <!-- <div class="address-line-one">
                                <h3 class="text-lg text-primary mt-2">Project Address</h3>
                                <div class="flex flex-col">
                                    <label for="" class="mt-2">Address</label>
                                    <input type="hidden" class="form-control" name="address_id[]" 
                                    value="{{ $project->addresses[0]->id ?? 0 }}" />
                                    <input type="text" name="address[]" class="form-control"
                                        value="{{ $project->addresses[0]->address ?? '' }}">
                                    <div class="flex">
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                            <label for="">Suburb</label>
                                            <input type="text" name="suburb[]" class="form-control"
                                                value="{{ $project->addresses[0]->suburb ?? '' }}">
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                            <label for="">State</label>
                                            <input type="text" name="state[]" class="form-control"
                                                value="{{ $project->addresses[0]->state ?? '' }}">
                                        </div>
                                        <div class="flex flex-col pt-4 mr-4 w-1/2">
                                            <label for="">Postcode</label>
                                            <input type="text" name="postcode[]" class="form-control"
                                                value="{{ $project->addresses[0]->postcode ?? '' }}">
                                                @error('postcode.0')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
        
                        <div class="w-1/2 pl-4 border-l-2">
                            <div class="flex flex-col pt-4">
                                <label for="">Project Notes</label>
                                <textarea name="project_notes" class="form-control" cols="30" rows="10" class="">{{$project->project_notes}}</textarea>
                                @error('project_notes')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                    </fieldset>
                </div>

                <!-- <div class="w-full pt-4 mr-6">
                    <h2 class="text-xl">Project Contact Details <span class="text-red-800">*</span>
                    </h2>
                    <table class="table mt-5 uppercase">
                        <thead class="text-center">
                            <tr>
                                <th>CONTACT NAME</th>
                                <th>CONTACT EMAIL</th>
                                <th>CONTACT PHONE</th>
                                <th>IS PRIMARY</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control" name="contact_id[]"
                                        value="{{ $project->contacts[0]->id ?? 0 }}" />
                                    <input type="text" class="form-control" name="contact_name[]"
                                        placeholder="Contact Name"
                                        value="{{ $project->contacts[0]->contact_name ?? '' }}">
                                </td>

                                <td>
                                    <input type="email" class="form-control" name="contact_email[]"
                                        placeholder="Contact Email"
                                        value="{{ $project->contacts[0]->contact_email ?? '' }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="contact_phone[]"
                                        placeholder="Contact Phone"
                                        value="{{ $project->contacts[0]->contact_phone ?? '' }}"
                                        onblur="checkPhone(this)">
                                    <span class="text-danger ml-5" role="alert"><strong></strong></span>
                                </td>

                                <td>
                                    <input type="hidden" name="is_primary[]" value="0">
                                    <input id="checkbox-switch-2" name="is_primary[]" class="form-check-input"
                                        value="1" type="checkbox" onClick="updateCheckBox(this)"
                                        @if (!empty($project->contacts[0]->is_primary)) checked="checked" @endif>
                                    <label class="form-check-label" for="checkbox-switch-2"></label>
                                    @error('is_primary')
                                        <span class="text-danger ml-5" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                <td>
                                    <select class="form-control" name="status[]">
                                        <option value="active"
                                            @if (isset($project->contacts[0]->status) && $project->contacts[0]->status == 'active') selected="selected" @endif>Active
                                        </option>
                                        <option value="inactive"
                                            @if (isset($project->contacts[0]->status) && $project->contacts[0]->status == 'inactive') selected="selected" @endif>Inactive
                                        </option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="hidden" class="form-control" name="contact_id[]"
                                        value="{{ $project->contacts[1]->id ?? 0 }}" />

                                    <input type="text" class="form-control" name="contact_name[]"
                                        placeholder="Contact Name"
                                        value="{{ $project->contacts[1]->contact_name ?? '' }}">
                                </td>
                                <td>
                                    <input type="email" class="form-control" name="contact_email[]"
                                        placeholder="Contact Email"
                                        value="{{ $project->contacts[1]->contact_email ?? '' }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="contact_phone[]"
                                        placeholder="Contact Phone"
                                        value="{{ $project->contacts[1]->contact_phone ?? '' }}"
                                        onblur="checkPhone(this)">
                                    <span class="text-danger ml-5" role="alert"><strong></strong></span>
                                </td>
                                <td>
                                    <input type="hidden" name="is_primary[]" value="0">
                                    <input id="checkbox-switch-3" name="is_primary[]" class="form-check-input"
                                        value="1" type="checkbox" onClick="updateCheckBox(this)"
                                        @if (!empty($project->contacts[1]->is_primary)) checked="checked" @endif>
                                    <label class="form-check-label" for="checkbox-switch-3"></label>
                                    @error('is_primary')
                                        <span class="text-danger ml-5" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" name="status[]">
                                        <option value="active"
                                            @if (isset($project->contacts[1]->status) && $project->contacts[1]->status == 'active') selected="selected" @endif>Active
                                        </option>
                                        <option value="inactive"
                                            @if (isset($project->contacts[1]->status) && $project->contacts[1]->status == 'inactive') selected="selected" @endif>Inactive
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control" name="contact_id[]"
                                        value="{{ $project->contacts[2]->id ?? 0 }}" />

                                    <input type="text" class="form-control" name="contact_name[]"
                                        placeholder="Contact Name"
                                        value="{{ $project->contacts[2]->contact_name ?? '' }}">
                                </td>
                                <td>
                                    <input type="email" class="form-control" name="contact_email[]"
                                        placeholder="Contact Email"
                                        value="{{ $project->contacts[2]->contact_email ?? '' }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="contact_phone[]"
                                        placeholder="Contact Phone"
                                        value="{{ $project->contacts[2]->contact_phone ?? '' }}"
                                        onblur="checkPhone(this)">
                                    <span class="text-danger ml-5" role="alert"><strong></strong></span>
                                </td>
                                <td>
                                    <input type="hidden" name="is_primary[]" value="0">
                                    <input id="checkbox-switch-4" name="is_primary[]" class="form-check-input"
                                        value="1" type="checkbox" onClick="updateCheckBox(this)"
                                        @if (!empty($project->contacts[2]->is_primary)) checked="checked" @endif>
                                    <label class="form-check-label" for="checkbox-switch-4"></label>
                                    @error('is_primary')
                                        <span class="text-danger ml-5" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" name="status[]">
                                        <option value="active"
                                            @if (isset($project->contacts[2]->status) && $project->contacts[2]->status == 'active') selected="selected" @endif>Active
                                        </option>
                                        <option value="inactive"
                                            @if (isset($project->contacts[2]->status) && $project->contacts[2]->status == 'inactive') selected="selected" @endif>Inactive
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control" name="contact_id[]"
                                        value="{{ $project->contacts[3]->id ?? 0 }}" />

                                    <input type="text" class="form-control" name="contact_name[]"
                                        placeholder="Contact Name"
                                        value="{{ $project->contacts[3]->contact_name ?? '' }}">
                                </td>
                                <td>
                                    <input type="email" class="form-control" name="contact_email[]"
                                        placeholder="Contact Email"
                                        value="{{ $project->contacts[3]->contact_email ?? '' }}"
                                        onblur="IsEmail(this.value)">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="contact_phone[]"
                                        placeholder="Contact Phone"
                                        value="{{ $project->contacts[3]->contact_phone ?? '' }}"
                                        onblur="checkPhone(this)">
                                    <span class="text-danger ml-5" role="alert"><strong></strong></span>
                                </td>
                                <td>
                                    <input type="hidden" name="is_primary[]" value="0">
                                    <input id="checkbox-switch-5" name="is_primary[]" class="form-check-input"
                                        value="1" type="checkbox" onClick="updateCheckBox(this)"
                                        @if (!empty($project->contacts[3]->is_primary)) checked="checked" @endif>
                                    <label class="form-check-label" for="checkbox-switch-5"></label>
                                    @error('is_primary')
                                        <span class="text-danger ml-5" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" name="status[]">
                                        <option value="active"
                                            @if (isset($project->contacts[3]->status) && $project->contacts[3]->status == 'active') selected="selected" @endif>Active
                                        </option>
                                        <option value="inactive"
                                            @if (isset($project->contacts[3]->status) && $project->contacts[3]->status == 'inactive') selected="selected" @endif>Inactive
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control" name="contact_id[]"
                                        value="{{ $project->contacts[4]->id ?? 0 }}" />
                                    <input type="text" class="form-control" name="contact_name[]"
                                        placeholder="Contact Name"
                                        value="{{ $project->contacts[4]->contact_name ?? '' }}">
                                </td>
                                <td>
                                    <input type="email" class="form-control" name="contact_email[]"
                                        placeholder="Contact Email"
                                        value="{{ $project->contacts[4]->contact_email ?? '' }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="contact_phone[]"
                                        placeholder="Contact Phone"
                                        value="{{ $project->contacts[4]->contact_phone ?? '' }}"
                                        onblur="checkPhone(this)">
                                    <span class="text-danger ml-5" role="alert"><strong></strong></span>
                                </td>
                                <td>
                                    <input type="hidden" name="is_primary[]" value="0">
                                    <input id="checkbox-switch-6" name="is_primary[]" class="form-check-input"
                                        value="1" type="checkbox" onClick="updateCheckBox(this)"
                                        @if (!empty($project->contacts[4]->is_primary)) checked="checked" @endif>
                                    <label class="form-check-label" for="checkbox-switch-6"></label>
                                    @error('is_primary')
                                        <span class="text-danger ml-5" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" name="status[]">
                                        <option value="active"
                                            @if (isset($project->contacts[4]->status) && $project->contacts[4]->status == 'active') selected="selected" @endif>Active
                                        </option>
                                        <option value="inactive"
                                            @if (isset($project->contacts[4]->status) && $project->contacts[4]->status == 'inactive') selected="selected" @endif>Inactive
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> <br>-->

                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-5">
                    <h2 class="text-xl">Project Contacts
                    </h2>

                    <input type="hidden" name="allContact" id="allContact" class="form-control">
                        <div class="intro-y overflow-auto lg:overflow-visible">
                            <div class="flex">
                                <div class="flex flex-col pt-4">
                                    <a class="items-center mr-3 btn btn-pending btn-sm btn-duplicate" href="javascript:;" data-tw-toggle="modal" 
                                    data-tw-target="#contact-modal">Add Contact</a>
                                </div>
                            </div>
                                <table id="contactTable" class="table table-striped table-bordered table-responsive 2xl:mt-2">
                                    <thead>
                                        <tr>
                                            <th>Contact Name</th>
                                            <th>Contact Email</th>
                                            <th>Contact Phone</th>
                                            <th>Is Primary</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                        </div>
                </div>

                <br><br>

                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-5">
                    <h2 class="text-xl">Project Addresses
                    </h2>

                    <input type="hidden" name="allAddress" id="allAddress" class="form-control">
                        <div class="intro-y overflow-auto lg:overflow-visible">
                            <div class="flex">
                                <div class="flex flex-col pt-4">
                                    <a class="items-center mr-3 btn btn-pending btn-sm btn-duplicate" href="javascript:;" data-tw-toggle="modal" 
                                    data-tw-target="#address-modal">Add Address</a>
                                </div>
                            </div>
                                <table id="addressTable" class="table table-striped table-bordered table-responsive 2xl:mt-2">
                                    <thead>
                                        <tr>
                                            <th>Address</th>
                                            <th>Suburb</th>
                                            <th>State</th>
                                            <th>Postcode</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                        </div>
                </div>
        
            </div>
            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                <a href="{{route('projects.index')}}"
                    class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
            </div>
        </form>
        
     </div>
    </div>

    <div id="address-modal" class="modal modal-lg" tabindex="-1" aria-hidden="true" style="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0 w-full">
                    <div class="pt-5 pl-5">
                        <h2 id="modal_address_title" class="text-xl text-center text-primary pb-4">New Address</h2>
                        <div id="messageAlert" class="alert alert-dismissible flex items-center mb-2 mr-4"
                            role="alert">
                            <span></span>
                            <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i
                                    data-lucide="x" class="w-4 h-4"></i></button>
                        </div>
                    </div>
                    <fieldset class=" p-5">
                        <div class="flex flex-col mb-5">
                            <label for="">Address</label>
                            <input type="text" name="address" class="form-control"
                                id="address">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="">Suburb</label>
                            <input type="text" name="suburb" class="form-control"
                                id="suburb">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="">State</label>
                            <input type="text" name="state" id="state" class="form-control">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="">Postcode</label>
                            <input type="text" name="postcode" id="postcode" class="form-control">
                        </div>
                        <div class="pt-4 mt-5">
                            <button type="button" data-tw-dismiss="modal"
                                class="btn  border-slate-300 text-slate w-24 mr-1" onclick="clearModal();">Close</button>
                            <button type="button"
                                class="btn bg-primary text-white w-24 mr-1" data-tw-dismiss="modal" onclick="saveAddress();">Save</button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div id="contact-modal" class="modal modal-lg" tabindex="-1" aria-hidden="true" style="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0 w-full">
                    <div class="pt-5 pl-5">
                        <h2 id="modal_contact_title" class="text-xl text-center text-primary pb-4">New Contact</h2>
                        <div id="messageAlert" class="alert alert-dismissible flex items-center mb-2 mr-4"
                            role="alert">
                            <span></span>
                            <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i
                                    data-lucide="x" class="w-4 h-4"></i></button>
                        </div>
                    </div>
                    <fieldset class=" p-5">
                        <div class="flex flex-col mb-5">
                            <label for="">Contact Name</label>
                            <input type="text" name="contact_name" class="form-control"
                                id="contact_name">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="">Contact Email</label>
                            <input type="text" name="contact_email" class="form-control"
                                id="contact_email">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="">Contact Phone</label>
                            <input type="text" name="contact_phone" id="contact_phone" class="form-control">
                        </div>
                        <div class="flex flex-col mb-5">
                            <div class="flex-col w-1/2 ">
                                <input id="is_primary" type="checkbox" name="is_primary" class="form-check-input">
                                <label for="is-primary">Is Primary</label>
                            </div>
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="pt-4 mt-5">
                            <button type="button" data-tw-dismiss="modal"
                                class="btn  border-slate-300 text-slate w-24 mr-1" onclick="clearModalContact();">Close</button>
                            <button type="button"
                                class="btn bg-primary text-white w-24 mr-1" data-tw-dismiss="modal" onclick="saveContact();">Save</button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        function updateCheckBox(checkbox) {
            // Get all checkboxes with the same name attribute
            // var checkboxes = document.getElementsByName(checkbox.name);
            var checkboxes = document.getElementsByClassName('form-check-input');
            console.log(checkboxes, checkbox);
            // Loop through all checkboxes and uncheck them except for the clicked one
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] !== checkbox) {
                    checkboxes[i].checked = false;
                    checkboxes[i].value = 0;
                } else {
                    checkboxes[i].value = 1;
                }
            }
        }

        function checkPhone(phone) {
            var regex = /^(04|\+614)[0-9]{8}$/;
            if (!regex.test(phone.value)) {
                $(phone).parent('td').find('span strong').html('Invalid Phone');
                return false;
            } else {
                $(phone).parent('td').find('span strong').html('');
                return true;
            }
        }

        var allAddress = [];
        var address_status = 'add'
        var address_index = ''

        function clearModal() {
            $("#address").val("")
            $("#suburb").val("")
            $("#state").val("")
            $("#postcode").val("")

            address_status = 'add'
            address_index  = ''
            $("#modal_address_title").text("New Address");
        }

        //Save Address
        function saveAddress() {
            if (address_status == 'add'){
                var addresses = {
                    id: null,
                    address: $("#address").val(),
                    suburb: $("#suburb").val(),
                    state: $("#state").val(),
                    postcode: $("#postcode").val(),
                }

                allAddress.push(addresses)
                
            }else{

                allAddress[address_index].address = $("#address").val()
                allAddress[address_index].suburb = $("#suburb").val()
                allAddress[address_index].state = $("#state").val()
                allAddress[address_index].postcode =  $("#postcode").val()
                
            }

            displayAddress();
            clearModal()
        }

        //Edit Address
        $(document).on('click', '.edit-address', function(e){
                e.preventDefault();
                var currentRow = $(this).closest('tr');

                var index = parseInt(currentRow.data('id'))

                const el = document.querySelector("#address-modal");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();

                var record = allAddress.at(index)

                $("#address").val(record.address)
                $("#suburb").val(record.suburb)
                $("#state").val(record.state)
                $("#postcode").val(record.postcode)

                address_status = 'update'
                address_index = index

                $("#modal_address_title").text("Update Address");
        });

        //Delete Address
        $(document).on('click', '.delete-address', function(e){
                e.preventDefault();
                var currentRow = $(this).closest('tr');
                var index = parseInt(currentRow.data('id'))

                allAddress.splice(index,1)
                displayAddress()
        });

        function displayAddress() {
            jQuery("#addressTable tbody").empty();

            allAddress.forEach(function (item, index) {
                jQuery("#addressTable tbody").append("<tr data-id='"  + index + "'>" +
                    "<td>" + item.address + "</td>" +
                    "<td>" + item.suburb + "</td>" +
                    "<td>" + item.state + "</td>" +
                    "<td>" + item.postcode + "</td>" +
                    "<td>" + "<div class='flex justify-center items-center'><a class='flex items-center mr-3 btn btn-warning btn-sm edit-address'>Edit</a><a class='flex items-center mr-3 btn btn-pending btn-sm btn-duplicate delete-address' href='javascript:;'>Delete</a></div>" + "</td>" +
                    "</tr>");
                })

            $("#allAddress").val(JSON.stringify(allAddress));
        }

        function setAddresses(){
            if (project.addresses.length > 0){
                allAddress = project.addresses
            }

            displayAddress()
        }

        var project = {!! $project->toJson() !!};

        $(document).ready(function(){
            setAddresses();
            setContacts();            
        });


        function setContacts(){
            if (project.contacts.length > 0){
                allContact = project.contacts
            }

            displayContact()
        }

        /**********Contacts***********************************/

        var allContact = [];
        var contact_status = 'add'
        var contact_index = ''

        function clearModalContact() {
            $("#contact_name").val("")
            $("#contact_email").val("")
            $("#contact_phone").val("")
            $("#is_primary").val(0)
            $("#status").val("active")

            jQuery('#is_primary').prop('checked', false);

            contact_status = 'add'
            contact_index  = ''
            $("#modal_contact_title").text("New Contact");
        }

        //Save Contact
        function saveContact() {
            if (contact_status == 'add'){
                var contacts = {
                    id: null,
                    contact_name: $("#contact_name").val(),
                    contact_email: $("#contact_email").val(),
                    contact_phone: $("#contact_phone").val(),
                    is_primary: $("#is_primary").val(),
                    status: $("#status").val(),
                }

                allContact.push(contacts)
                
            }else{

                allContact[contact_index].contact_name = $("#contact_name").val()
                allContact[contact_index].contact_email = $("#contact_email").val()
                allContact[contact_index].contact_phone = $("#contact_phone").val()
                allContact[contact_index].is_primary =  $("#is_primary").val()
                allContact[contact_index].status =  $("#status").val()
            }

            console.log(allContact)
            displayContact();
            clearModalContact()
        }

        //Edit Contact
        $(document).on('click', '.edit-contact', function(e){
                e.preventDefault();
                var currentRow = $(this).closest('tr');

                var index = parseInt(currentRow.data('id'))

                const el = document.querySelector("#contact-modal");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();

                var record = allContact.at(index)

                $("#contact_name").val(record.contact_name)
                $("#contact_email").val(record.contact_email)
                $("#contact_phone").val(record.contact_phone)
                $("#is_primary").val(record.is_primary)
                $("#status").val(record.status)

                if (record.is_primary == 1){
                    jQuery('#is_primary').prop('checked', true);
                }else{
                    jQuery('#is_primary').prop('checked', false);
                }

                contact_status = 'update'
                contact_index = index

                $("#modal_contact_title").text("Update Contact");
        });

        //Delete Contact
        $(document).on('click', '.delete-contact', function(e){
                e.preventDefault();
                var currentRow = $(this).closest('tr');
                var index = parseInt(currentRow.data('id'))

                allContact.splice(index,1)
                displayContact()
        });

        function displayContact() {
            jQuery("#contactTable tbody").empty();

            allContact.forEach(function (item, index) {
                jQuery("#contactTable tbody").append("<tr data-id='"  + index + "'>" +
                    "<td>" + item.contact_name + "</td>" +
                    "<td>" + item.contact_email + "</td>" +
                    "<td>" + item.contact_phone + "</td>" +
                    "<td>" + IsPrimary(item.is_primary) + "</td>" +
                    "<td>" + helper.capitalizeFirstLetter(item.status) + "</td>" +
                    "<td>" + "<div class='flex justify-center items-center'><a class='flex items-center mr-3 btn btn-warning btn-sm edit-contact'>Edit</a><a class='flex items-center mr-3 btn btn-pending btn-sm btn-duplicate delete-contact' href='javascript:;'>Delete</a></div>" + "</td>" +
                    "</tr>");
                })

            $("#allContact").val(JSON.stringify(allContact));
        }

        function IsPrimary(is_primary){
            return (is_primary==1) ? "Yes" : "No"
        }

        $('#is_primary').prop('checked', false);
        const is_primary = document.querySelector('#is_primary');

        is_primary.addEventListener('change', function() {
            if ($('#is_primary').is(':checked')) {
                $('#is_primary').val(1)
            }else{
                $('#is_primary').val(0)
            }
        });
    </script>
    <!-- @vite('resources/js/ckeditor-classic.js')
    <script defer src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"></script> -->
@endsection


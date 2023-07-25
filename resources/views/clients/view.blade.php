@extends('../layout/' . $layout)

@section('subhead')
    <title>View Client | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Client View</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12 2xl:col-span-12">
            <!-- BEGIN: View Client -->
            <div class="intro-y box p-5">
                <div class="p-5">
                        <fieldset class="w-1/2 pt-4 mr-6">
                            <h2 class="text-xl">Company Details <span class="text-red-800">*</span>
                            </h2>
                            <div class="flex flex-col pt-4">
                                <label for="">Company Name</label>
                                <input name="name" type="text" value="{{$client->name}}"
                                    class="form-control" >
                                @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col pt-4">
                                <label for="">Company Address</label>
                                <input  name="address" type="text" value="{{$client->address}}"
                                    class="form-control">
                                @error('address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col pt-4">
                                <label for="">ABN</label>
                                <input  name="abn" type="text" value="{{$client->abn}}"
                                    class="form-control" >
                                @error('abn')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col pt-4">
                                <label for="">Client Number</label>
                                <input  name="client_number" type="text" value="{{$client->client_number}}"
                                    class="form-control" >
                                @error('client_number')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col pt-4">
                                <label for="">Client Notes</label>
                                <textarea name="client_notes" value="{{$client->client_notes}}" cols="15" rows="10" class="h-20">{{$client->client_notes}}</textarea>
                                @error('client_notes')
                               <p class="text-danger">
                                    {{$message}}
                               </p>
                               @enderror
                            </div>
                           
                    
                        </fieldset>
                        <div class="w-full pt-4 mr-6">
                            <h2 class="text-xl">Company Contact Details <span class="text-red-800">*</span>
                            </h2>
                            <!--Contact Details Form-->
                            <table class="table mt-5 uppercase">
                                <thead class="text-center">
                                    <tr>
                                        <th>Contact Name</th>
                                        <th>Contact Email</th>
                                        <th>Contact Phone</th>
                                        <th>Is Primary</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="text-center">
                                    @if(count($client->contacts) > 0)
                                    <tr>
                                        <td>
                                            <input type="hidden" class="form-control" name="contact_id[]" value="{{$client->contacts[0]->id ?? 0}}" />
                                            <input type="text" class="form-control" name="contact_name[]"
                                                placeholder="Contact Name" value="{{$client->contacts[0]->contact_name ?? ''}}">
                                        </td>

                                        <td>
                                            <input type="text" class="form-control" name="contact_email[]"
                                                placeholder="Contact Email" value="{{$client->contacts[0]->contact_email ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="contact_phone[]"
                                                placeholder="Contact Phone" value="{{$client->contacts[0]->contact_phone ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="hidden" name="is_primary[]" value="0">
                                            <input id="checkbox-switch-2" name="is_primary[]" class="form-check-input"
                                                value="1" type="checkbox" onClick="updateCheckBox(this)" @if($client->contacts[0]->is_primary) checked="checked" @endif>
                                            <label class="form-check-label" for="checkbox-switch-2"></label>
                                            @error('is_primary')
                                                <span class="text-danger ml-5" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="form-control" name="status[]">
                                                <option value="active" @if($client->contacts[0]->status == "active")selected="selected" @endif>Active</option>
                                                <option value="inactive" @if($client->contacts[0]->status == "inactive")selected="selected" @endif>Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="hidden" class="form-control" name="contact_id[]" value="{{$client->contacts[1]->id ?? 0}}" />

                                            <input type="text" class="form-control" name="contact_name[]"
                                                placeholder="Contact Name" value="{{$client->contacts[1]->contact_name ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="contact_email[]"
                                                placeholder="Contact Email" value="{{$client->contacts[1]->contact_email ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="contact_phone[]"
                                                placeholder="Contact Phone" value="{{$client->contacts[1]->contact_phone ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="hidden" name="is_primary[]" value="0">
                                            <input id="checkbox-switch-3" name="is_primary[]" class="form-check-input"
                                                value="1" type="checkbox"  onClick="updateCheckBox(this)" @if($client->contacts[1]->is_primary) checked="checked" @endif>
                                            <label class="form-check-label" for="checkbox-switch-3"></label>
                                            @error('is_primary')
                                                <span class="text-danger ml-5" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="form-control" name="status[]">
                                                <option value="active" @if($client->contacts[1]->status == "active")selected="selected" @endif>Active</option>
                                                <option value="inactive" @if($client->contacts[1]->status == "inactive")selected="selected" @endif>Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="hidden" class="form-control" name="contact_id[]" value="{{$client->contacts[2]->id ?? 0}}" />

                                            <input type="text" class="form-control" name="contact_name[]" placeholder="Contact Name" value="{{$client->contacts[2]->contact_name ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="contact_email[]" placeholder="Contact Email" value="{{$client->contacts[2]->contact_email ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="contact_phone[]" placeholder="Contact Phone" value="{{$client->contacts[2]->contact_phone ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="hidden" name="is_primary[]" value="0">
                                            <input id="checkbox-switch-4" name="is_primary[]" class="form-check-input"
                                                value="1" type="checkbox"  onClick="updateCheckBox(this)" @if($client->contacts[2]->is_primary) checked="checked" @endif>
                                            <label class="form-check-label" for="checkbox-switch-4"></label>
                                            @error('is_primary')
                                                <span class="text-danger ml-5" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="form-control" name="status[]">
                                                <option value="active" @if($client->contacts[2]->status == "active")selected="selected" @endif>Active</option>
                                                <option value="inactive" @if($client->contacts[2]->status == "inactive")selected="selected" @endif>Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="hidden" class="form-control" name="contact_id[]" value="{{$client->contacts[3]->id ?? 0}}" />

                                            <input type="text" class="form-control" name="contact_name[]" placeholder="Contact Name" value="{{$client->contacts[3]->contact_name ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="contact_email[]" placeholder="Contact Email" value="{{$client->contacts[3]->contact_email ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="contact_phone[]" placeholder="Contact Phone" value="{{$client->contacts[3]->contact_phone ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="hidden" name="is_primary[]" value="0">
                                            <input id="checkbox-switch-5" name="is_primary[]" class="form-check-input"
                                                value="1" type="checkbox" onClick="updateCheckBox(this)" @if($client->contacts[3]->is_primary) checked="checked" @endif>
                                            <label class="form-check-label" for="checkbox-switch-5"></label>
                                            @error('is_primary')
                                                <span class="text-danger ml-5" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="form-control" name="status[]">
                                                <option value="active" @if($client->contacts[3]->status == "active")selected="selected" @endif>Active</option>
                                                <option value="inactive" @if($client->contacts[3]->status == "inactive")selected="selected" @endif>Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="hidden" class="form-control" name="contact_id[]" value="{{$client->contacts[4]->id ?? 0}}" />
                                            <input type="text" class="form-control" name="contact_name[]" placeholder="Contact Name" value="{{$client->contacts[4]->contact_name ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="contact_email[]"
                                                placeholder="Contact Email" value="{{$client->contacts[4]->contact_email ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="contact_phone[]" placeholder="Contact Phone" value="{{$client->contacts[4]->contact_phone ?? ''}}">
                                        </td>
                                        <td>
                                            <input type="hidden" name="is_primary[]" value="0">
                                            <input id="checkbox-switch-6" name="is_primary[]" class="form-check-input"
                                                value="1" type="checkbox" onClick="updateCheckBox(this)" @if($client->contacts[4]->is_primary) checked="checked" @endif>
                                            <label class="form-check-label" for="checkbox-switch-6"></label>
                                            @error('is_primary')
                                                <span class="text-danger ml-5" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="form-control" name="status[]">
                                               <option value="active" @if($client->contacts[4]->status == "active")selected="selected" @endif>Active</option>
                                                <option value="inactive" @if($client->contacts[4]->status == "inactive")selected="selected" @endif>Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    @endif
                                 </tbody>
                            </table>    
                        </div>
                        
                    </div>
                    <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                        <a href="{{ route('clients.index') }} "
                            class="btn py-3 btn-primary w-full md:w-52">Back to Client</a>
                    </div>

                </fieldset>
            </div>
        </div>
    </div>
   

@endsection

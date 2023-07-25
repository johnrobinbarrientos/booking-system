@extends('../layout/' . $layout)

@section('subhead')
    <title>Update Project | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Edit Subbie</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
     <div class="intro-y col-span-12 2xl:col-span-12">
        <form action="{{ route('subbies.update', $subby->id ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="intro-y box p-5">
                <div class="p-5">
                    <fieldset class="flex w-full">
                        <div class="w-1/2 mr-4">
                            <h2 class="text-xl text-primary">Subbie Details</h2>
                            <div class="flex flex-col pt-4">
                                <label for=""> Name </label>
                                <input type="text" name="name" value="{{$subby->name}}" class="form-control">
                                @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="flex flex-col pt-4">
                                <label for="" class="form-label">Subbie Contact Number 
                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500 text-success">e.g, 0469309713 or +61469309713  </span>
                                </label>
                               <input type="text" name="contact_number" value="{{$subby->contact_number}}" class="form-control">
                               <span class="text-danger ml-5" role="alert"><strong></strong></span>
                                @error('contact_number')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="flex  flex-col md:flex-row gap-2 mt-5">
                <a href="{{route('subbies.index')}}"
                    class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
            </div>
        </form>
     </div>
    </div>
@endsection


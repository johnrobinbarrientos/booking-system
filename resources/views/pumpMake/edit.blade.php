@extends('../layout/' . $layout)

@section('subhead')
    <title>Update Pump Make | Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Update Pump Make</h2>
    </div>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12 2xl:col-span-12">
            <form action="{{route('pumpMake.update', $pumpMake->id)}}" method="POST"  class="w-full">
                @csrf
                @method('PUT')
                <div class="intro-y box p-5">
                    <div class="p-5">
                        <fieldset class="flex w-full">
                            <div class="w-1/2 mr-4">
                                <h2 class="text-xl text-primary">Pump Make Details</h2>
                                <div class="flex flex-col pt-4">
                                    <label for=""> Make </label>
                                    <input type="text" name="make" value="{{$pumpMake->make}}" class="form-control">
                                    @error('make')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row gap-2 mt-5">
                    <a href="{{route('pumpMake.index')}}"
                        class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                    <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection


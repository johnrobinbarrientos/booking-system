@extends('../layout/' . $layout)

@section('subhead')
    <title>Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
<h2 class="intro-y text-lg font-medium mt-5">Hist</h2>
<a href="{{route('bookings.index')}}" class="btn btn-default mt-5"> <i data-lucide="arrow-left" class="w-5 h-5 mr-1"></i> Back to Bookings</a>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <table class="table table-striped table-responsive 2xl:mt-2">
            <thead class="border-b bg-rounded bg-primary text-white">
                <tr>
                    <th>User</th>
                    <th>Description</th>
                    <th>Booking Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                    <tr>
                        <td>{{ $activity->causer->name }}</td>
                        <td>{{ $activity->description }}</td>
                        @if ($activity->log_name == 'default')
                        <?php $properties = json_decode($activity->properties, true); ?>
                            <td>{{$properties["attributes"]["booking_status"]}}</td>
                        @endif
                        <td>{{Carbon\Carbon::parse($activity->created_at)->format('d-m-y h:i:s A') }}</td>
                        <td>{{Carbon\Carbon::parse($activity->updated_at)->format('d-m-y h:i:s A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
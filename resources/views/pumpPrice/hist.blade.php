@extends('../layout/' . $layout)

@section('subhead')
    <title>Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
<h2 class="intro-y text-lg font-medium mt-5">Pricing Hist</h2>
<a href="{{route('pump-prices.index')}}" class="btn btn-default mt-5"> <i data-lucide="arrow-left" class="w-5 h-5 mr-1"></i> Back to Pump Prices</a>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <table class="table table-report table-auto 2xl:mt-2">
            <thead class="border-b bg-rounded bg-primary text-white">
                <tr>
                    <th>User</th>
                    <th>Description</th>
                    <th>Price Changes</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr>
                        <td>{{ $activity->causer->name }}</td>
                        <td>{{ $activity->description }}</td>
                        @if ($activity->log_name == 'default')
                        <?php $properties = json_decode($activity->properties, true); ?>
                            <td class="text-primary">Price Group: {{ \App\Models\PriceGroup::find($properties["attributes"]["price_group_id"])->location_name ?? '' }},
                                Size: {{$properties["attributes"]["size"]}},
                                Min Hire: {{$properties["attributes"]["min_hire_first_2_hours_on_site"]}},
                                Extra Time {{$properties["attributes"]["extra_time_per_hour"]}},
                                Per Cubic Metre {{$properties["attributes"]["per_cube_meter_of_concrete"]}}
                            </td>
                        @endif
                        <td>{{Carbon\Carbon::parse($activity->created_at)->format('d-m-y h:i:s A') }}</td>
                        <td>{{Carbon\Carbon::parse($activity->updated_at)->format('d-m-y h:i:s A') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-danger text-center text-xl">No Records Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $activities->links() }}

@endsection
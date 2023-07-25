@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img alt="" src="{{ asset('build/assets/images/rowland-logo.png') }}">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

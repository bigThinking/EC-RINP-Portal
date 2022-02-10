<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('images') }}/rinp_logo.png" class="logo" alt="EC-RINP Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

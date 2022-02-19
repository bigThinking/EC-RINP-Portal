@component('mail::message')
Dear {{$org_name}} team

Your application for the call "{{$call_title}}" has been recorded and forwarded to the relevant organisation. 

They will be contacting you via email to take the process further. For any enquiries please contact admin@innovateec.co.za.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

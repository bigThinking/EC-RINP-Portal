@component('mail::message')
Dear {$facilitator_org_name}} team

A resource request has been received titled "{{$task_title}}" from {{$applicant_org_name}}

Please logon to the EC-RINP portal to view and reply to the request. For any enquiries contact admin@innovateec.co.za.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

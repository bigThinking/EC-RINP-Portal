@component('mail::message')
Dear {{$receiver_org_name}} team

An application for the call "{{$call_title}}" has been received from {{$applicant_org_name}}. 

Please logon to the EC-RINP portal for more information. For any enquiries contact admin@innovateec.co.za.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
Dear {{$applicant_org_name}} team

Your resource request titled "{{$task_title}}" has received a response from {{$facilitator_org_name}}

Please contact your assisting incubator. For any enquiries contact admin@innovateec.co.za.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

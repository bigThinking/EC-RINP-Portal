@component('mail::message')
Dear {{$admin_name}}

A new user has signed up on the EC-RINP portal. Please review their account and approve/reject as soon as possible. Details below

Full name: {{$username}}
email: {{$email}}
Organisation: {{$organisation}}
Job title: {{$job_title}}
Innovator? : {{$is_innovator}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

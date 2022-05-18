@component('mail::message')
Dear {{$admin_name}}

A new user has signed up on the EC-RINP portal. Please review their account and approve/reject as soon as possible. Details below <br>

Full name: {{$username}}<br>
email: {{$email}}<br>
Organisation: {{$organisation}}<br>
Job title: {{$job_title}}<br> 
Innovator? : {{$is_innovator}}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

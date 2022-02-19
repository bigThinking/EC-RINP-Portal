@component('mail::message')
Dear {{$username}}

Your EC-RINP portal account has been approved. You may now access the functionality of the portal.

As a first step, please create your organisation profile if your organisation isn't currently listed on the portal. 
After this, if you are an innovator, please also input information on your project.

For any enquiries please contact admin@innovateec.co.za.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

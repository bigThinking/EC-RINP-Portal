@component('mail::message')
Dear {{$username}}

Welcome to the Eastern Cape Regional Innovation Platform (EC-RINP). The EC-RINP portal is an initiative of the EC-RINP which aims to ease co-ordination between the various stakeholders in the Eastern cape's innovation ecosystem.

Your account is awaiting review by an administrator, after which you will have access to the functionalities of the portal.

For any enquiries please contact admin@innovateec.co.za.

Thank you,<br>
{{ config('app.name') }}
@endcomponent

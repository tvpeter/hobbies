@component('mail::message')
# Hello {{$user->firstName}},

This is to inform you that, you just deleted 
one of your hobbies from our records. This hobby
will no longer be tracked.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

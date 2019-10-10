@component('mail::message')
# Hello {{$user->firstName}},

This is to inform you that, your hobby __{{$hobby}}__ 
has been updated. 

Thank you,<br>
{{ config('app.name') }}
@endcomponent

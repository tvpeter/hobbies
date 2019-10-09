@component('mail::message')
### Hello {{$firstName }}

You just registered a new Hobby __{{$title}}__, and we are 
glad to help you keep watch on it.

Thank you.

With Love from,<br>
Team {{ config('app.name') }}
@endcomponent

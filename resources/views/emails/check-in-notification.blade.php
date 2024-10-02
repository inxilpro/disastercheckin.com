@component('mail::message')
# Check In From {{ $phone_number }}

@foreach($check_ins as $check_in)
**{{ $check_in->created_at }}**<br />{{ $check_in->body }}

@endforeach

@component('mail::button', ['url' => route('phone-number', $phone_number)])
    View All Check Ins
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

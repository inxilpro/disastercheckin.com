<h1>From: {{ $phone_number }}</h1>

@foreach($check_ins as $check_in)
    <p><b>{{ $check_in->created_at }}</b></p>
    <p>{{ $check_in->body }}</p><br>
@endforeach

<x-app-layout>

    <div class="prose">
        <h1>
            Check-ins from {{ $phone_number }}
        </h1>

        @forelse($phone_number->check_ins as $check_in)
            <p>{{ $check_in->created_at->diffForHumans() }} - {{ $check_in->body }}</p>
        @empty
            <p>
                We do not have any messages from {{ $phone_number }} yet.
                Check back again in 24 hours—we hope to add the ability to
                subscribe for updates shortly.
            </p>
        @endforelse
    </div>

</x-app-layout>

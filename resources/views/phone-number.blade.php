<x-app-layout>

    <x-slot:head>
        <meta name="robots" content="noindex"/>
    </x-slot:head>

    <h2 class="text-xl text-slate-700 font-semibold py-3.5 border-b border-slate-300">
        Check-ins from {{ $phone_number }}
    </h2>

    <div class="prose mt-4">
        @forelse($phone_number->check_ins as $check_in)
            <p>{{ $check_in->created_at->diffForHumans() }} - {{ $check_in->body }}</p>
        @empty
            <p>
                We do not have any messages from this number yet. Check back again in 24 hours.
            </p>
            <form class="text-right text-blue-800 font-medium">
                <button type="button" class="underline">Subscribe to this number</button>
            </form>
        @endforelse
    </div>

</x-app-layout>

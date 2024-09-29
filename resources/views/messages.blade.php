<x-app-layout>
    <h1>Communications From {{ $number->phone }}</h1>
    @forelse($number->messages->sortByDesc('created_at') as $message)
        <p>{{ $message->created_at->diffForHumans() }} - {{ $message->message }}</p>

    @empty
        We do not have any messages from {{ $number->phone }} yet.

        TODO: Someone please add a subscription form
    @endforelse
</x-app-layout>

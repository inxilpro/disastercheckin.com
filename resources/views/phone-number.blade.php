<x-app-layout>

    <x-slot:head>
        <meta name="robots" content="noindex"/>
    </x-slot:head>

    <div class="prose">
        <h2 class="text-slate-800 font-semibold tracking-tight py-3.5 border-b border-slate-300">
            Check-ins from {{ $phone_number }}
        </h2>

        @if($phone_number->check_ins->isNotEmpty())
            @php
                $latest_message = $phone_number->check_ins->first();
            @endphp

            <h3 class="text-lg mt-8 font-semibold flex justify-between items-center">
                <span class="text-slate-800 tracking-tight">Latest</span>
                <span class="font-normal opacity-80 text-sm">{{ $latest_message->created_at->diffForHumans() }}</span>
            </h3>

            <div class="mt-2 px-4 py-2 ring-1 ring-gray-300 rounded bg-slate-50/30 shadow-sm">
                {{ $latest_message->body }}
            </div>
            <x-subscribe-form />
            <h3 class="text-lg mt-8 text-slate-800 font-semibold tracking-tight">History</h3>
            <ul class="pl-0">
                @foreach($phone_number->check_ins->skip(1) as $check_in)
                    <li class="text-sm flex items-center gap-4 pl-0 py-0.5">
                        <div class="opacity-80 w-28">
                            <strong class="font-normal">{{ $check_in->created_at->diffForHumans() }}</strong>
                        </div>
                        <div>
                            {{ $check_in->body }}
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>
                We do not have any messages from this number yet. Check back again in 24 hours.
            </p>
            <x-subscribe-form />
        @endif
    </div>

</x-app-layout>

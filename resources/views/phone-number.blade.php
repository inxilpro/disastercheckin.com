<x-app-layout>

    <x-slot:head>
        <meta name="robots" content="noindex"/>
    </x-slot:head>

    <div class="mt-6">

        <h2 class="pb-2 text-xl font-semibold tracking-tight border-b text-slate-800 border-slate-300">
            Check-ins from <a href="sms:{{ phone_number($phone_number) }}?body=UPDATE">{{ $phone_number }}</a>
        </h2>

        @if($latest_check_in)

            <h3 class="flex items-center justify-between mt-6 text-lg font-semibold">
                <span class="tracking-tight text-slate-800">
                    Latest
                </span>
                <span
                    class="text-sm font-semibold text-slate-700"
                    data-timestamp="{{ $latest_check_in->created_at->unix() }}"
                >
                    {{ $latest_check_in->created_at->diffForHumans() }}
                </span>
            </h3>

            <div
                class="px-4 py-2 mt-2 font-medium text-green-900 shadow-sm ring-1 ring-green-500 rounded-r-md rounded-bl-md bg-green-200/30">
                {{ $latest_check_in->body }}
            </div>

            <x-subscribe-form :phone_number="$phone_number"/>

            @if($check_ins->isNotEmpty())

                <h3 class="mt-6 text-lg font-semibold tracking-tight text-slate-800">
                    Previous Check-ins
                </h3>

                <table class="mt-2 text-sm">
                    <thead class="sr-only">
                    <tr>
                        <th>Time</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($check_ins as $check_in)
                        <tr>
                            <td
                                class="py-1 pr-2 font-semibold align-top text-slate-700 whitespace-nowrap"
                                data-timestamp="{{ $check_in->created_at->unix() }}"
                            >
                                {{ $check_in->created_at->diffForHumans() }}
                            </td>
                            <td class="py-1 pl-2">
                                {{ $check_in->body }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @endif

        @else

            <p class="mt-6">
                We do not have any messages from this number yet. Check back again in 24 hours.
            </p>

            <x-subscribe-form :phone_number="$phone_number"/>

        @endif
    </div>

    <script>
        document.querySelectorAll('[data-timestamp]')
            .forEach(function (el) {
                el.title = new Date(el.dataset.timestamp * 1000).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
            });
    </script>

</x-app-layout>

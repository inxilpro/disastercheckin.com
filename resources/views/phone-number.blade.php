<x-app-layout>

    <x-slot:head>
        <meta name="robots" content="noindex"/>
    </x-slot:head>

    <div class="mt-6">

        <h2 class="text-xl text-slate-800 font-semibold tracking-tight border-b border-slate-300 pb-2">
            Check-ins from {{ $phone_number }}
        </h2>

        @if($latest_check_in)

            <h3 class="text-lg mt-6 font-semibold flex justify-between items-center">
                <span class="text-slate-800 tracking-tight">
                    Latest
                </span>
                <span
                    class="font-semibold text-slate-700 text-sm"
                    data-timestamp="{{ $latest_check_in->created_at->unix() }}"
                >
                    {{ $latest_check_in->created_at->diffForHumans() }}
                </span>
            </h3>

            <div
                class="mt-2 px-4 py-2 ring-1 ring-green-500 rounded-r-md rounded-bl-md bg-green-200/30 text-green-900 font-medium shadow-sm">
                {{ $latest_check_in->body }}
            </div>

            <x-subscribe-form :phone_number="$phone_number"/>

            @if($check_ins->isNotEmpty())

                <h3 class="text-lg mt-6 text-slate-800 font-semibold tracking-tight">
                    Previous Check-ins
                </h3>

                <table class="text-sm mt-2">
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
                                class="font-semibold text-slate-700 py-1 pr-2 whitespace-nowrap align-top"
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

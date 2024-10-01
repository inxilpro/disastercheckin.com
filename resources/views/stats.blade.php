<x-app-layout>

    <x-slot:head>
        <meta name="robots" content="noindex"/>
    </x-slot:head>

    <div class="mt-6">
        <h2 class="text-xl text-slate-800 font-semibold tracking-tight border-b border-slate-300 pb-2">
            Total stats:
        </h2>

        <h3 class="text-lg mt-6 font-semibold flex justify-between items-center">
            <span class="text-slate-800 tracking-tight">
                Unique phone numbers:
            </span>
            <span class="font-semibold text-slate-700 text-sm">
                {{ $total_phone_numbers }}
            </span>
        </h3>

        <h3 class="text-lg mt-6 font-semibold flex justify-between items-center">
            <span class="text-slate-800 tracking-tight">
                Unique checkins:
            </span>
            <span class="font-semibold text-slate-700 text-sm">
                {{ $total_check_ins }}
            </span>
        </h3>
    </div>

    <div class="mt-16 space-y-12">
        <h3 class="text-xl text-slate-800 font-semibold tracking-tight border-b border-slate-300 pb-2">
            Over last the last week:
        </h3>

        <x-week-stats :stats="$stats_phone_numbers" label="Unique phone numbers" />

        <x-week-stats :stats="$stats_check_ins" label="Unique checkins" />
    </div>

</x-app-layout>

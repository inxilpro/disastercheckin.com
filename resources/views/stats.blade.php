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
                {{ App\Models\PhoneNumber::query()->count() }}
            </span>
        </h3>

        <h3 class="text-lg mt-6 font-semibold flex justify-between items-center">
            <span class="text-slate-800 tracking-tight">
                Unique checkins:
            </span>
            <span class="font-semibold text-slate-700 text-sm">
                {{ App\Models\Checkin::query()->count() }}
            </span>
        </h3>
    </div>

</x-app-layout>

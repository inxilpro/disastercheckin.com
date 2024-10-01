@props(['stats', 'label'])

<section class="text-center mt-12">
    <h2 class="text-sm font-semibold text-gray-900 text-left">{{ $label }}</h2>
    <div class="mt-6 grid grid-cols-7 text-xs leading-6 text-gray-500">
        @foreach($stats as $value)
            <div>{{ $value->label }}</div>
        @endforeach
    </div>

    <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
        @foreach($stats as $index => $value)
            <button
                type="button"
                @class([
                    'relative py-1.5 text-gray-400 hover:bg-gray-100 focus:z-10',
                    'bg-gray-50' => $index !== count($stats) - 1,
                    'rounded-br-lg rounded-tr-lg bg-white' => $index === count($stats) - 1,
                    'rounded-bl-lg rounded-tl-lg' => $index === 0,
                ])>
                <time datetime="{{ $value->date }}" class="mx-auto flex h-7 w-7 items-center justify-center rounded-full">
                    {{ $value->aggregate }}
                </time>
            </button>
        @endforeach
    </div>
</section>

@props([
    'size' => 'sm',
])
<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => Arr::toCssClasses([
            'rounded-md bg-blue-600 font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 w-full sm:w-auto',
            'px-2 py-1 text-xs' => $size === 'xs',
            'px-2 py-1 text-sm' => $size === 'sm',
            'px-2.5 py-1.5 text-sm' => $size === 'md',
            'px-5 py-2 sm:text-sm' => $size === 'lg',
            'px-6 py-2.5 text-sm' => $size === 'xl',
        ]),
    ]) }}
>
    {{ $slot }}
</button>

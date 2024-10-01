@props([
    'id' => Str::random(),
    'label' => '',
    'name' => '',
])

<div>
    <label
        for="{{ $id }}"
        @class([
            'block text-sm font-medium leading-6',
            'text-gray-900' => !$errors->has($name),
            'text-red-800' => $errors->has($name),
        ])
    >
        {{ $label }}
    </label>
    <div class="relative mt-2 rounded-md shadow-sm">
        <input
            {{ $attributes->merge([
                'id' => $id,
                'name' => $name,
                'value' => old($name),
                'class' => Arr::toCssClasses([
                    'block w-full rounded-md border-0 py-2.5 shadow-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6',
                    'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-blue-600/70' => !$errors->has($name),
                    'pr-10 text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500' => $errors->has($name),
                ])
            ]) }}
            @error($name)
            aria-invalid="true"
            aria-describedby="{{ $id }}-error"
            @enderror
        >
        @error($name)
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg style="height: 20px; width: 20px;" class="w-5 h-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path
                    fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                    clip-rule="evenodd"
                />
            </svg>
        </div>
        @enderror
    </div>
    @error($name)
    <p class="mt-2 text-sm text-red-600" id="phone-error">
        {{ $message }}
    </p>
    @enderror
</div>

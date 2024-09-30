@props(['phone_number'])
<form
    method="post"
    action="{{ route('subscribe') }}"
    class="mt-6 border rounded-md p-4 bg-slate-50 border-slate-300 shadow-sm"
>

    @csrf

    <div class="text-sm font-semibold">
        Notify me
    </div>

    <p class="text-sm">
        If you would like to receive a notification when this number checks in, you can provide your email address
        below.
    </p>

    <x-input
        required
        name="email"
        type="email"
        inputmode="email"
        placeholder="me@gmail.com"
    />
    <input
        type="hidden"
        name="phone_number"
        value="{{ $phone_number }}"
    />

    @if(session()->get('message.success'))
        <div class="mt-4 flex items-start sm:items-center gap-2 justify-end">
            <span class="text-sm text-green-600 font-medium">{{ session()->get('message.success') }}</span>
            <svg style="height: 1rem; width: 1rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                 fill="currentColor" class="size-4 text-green-600">
                <path fill-rule="evenodd"
                      d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
    @endif

    <div class="mt-3 flex justify-end">
        <x-button
            type="submit"
            size="lg"
        >
            Subscribe
        </x-button>
    </div>
</form>

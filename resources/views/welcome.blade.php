<x-app-layout>

    <div class="prose">
        <p>If you are looking for information on a loved one, they may have checked in with us. We have provided a phone
            number to local media where people can send SMS updates about their well-being. You can search for your
            loved on
            by your user's phone number below:</p>
    </div>

    <form
        class="mt-8"
        method="post"
        action="{{ route('search') }}"
    >

        @csrf

        <div class="max-w-lg">
            <x-input
                required
                label="Phone Number"
                name="phone_number"
                type="tel"
                inputmode="tel"
                placeholder="eg. 828-555-1234"
            />

            <div class="my-6 border rounded p-4">
                <h2 class="text-sm font-semibold text-slate-500">
                    Optional
                </h2>

                <p class="mt-2">
                    <label for="email">
                        If you would like to receive future updates from this number, you may enter
                        your email address below.
                    </label>
                </p>

                <x-input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="eg. you@gmail.com"
                />
            </div>

        </div>

        <div class="mt-2">
            <x-button type="submit" size="xl">
                Search
            </x-button>
        </div>
    </form>

</x-app-layout>

<x-app-layout>

    <div class="border rounded-md border-amber-600 px-4 py-2.5 bg-yellow-50 shadow-sm">
        <h2 class="text-amber-900">
            Text this number if you are safe <strong class="whitespace-nowrap">(980) 324-2832</strong>
        </h2>
    </div>

    <div class="prose-sm max-w-lg mt-6">
        <p>
            If you are looking for information on a loved one, they may have checked in with us. We have provided a
            phone
            number to local media where people can send SMS updates about their well-being. You can search for your
            loved on
            by your user's phone number below:
        </p>
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

            <div class="mt-4 flex justify-end">
                <x-button type="submit" size="lg">
                    Search
                </x-button>
            </div>
        </div>
    </form>

</x-app-layout>

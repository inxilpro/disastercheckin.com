<x-app-layout>

    <div class="border rounded-md border-amber-600 px-4 py-2.5 bg-yellow-50 shadow-sm">
        <h2 class="text-amber-900">
            Text this number if you are safe <a href="sms:+18288880440?body=UPDATE"><strong class="whitespace-nowrap">828-888-0440</strong></a>
        </h2>
    </div>

    <div class="max-w-lg mt-6 prose-sm">
        <p>
            If you are looking for information on a loved one, they may have checked in with us. We have provided a
            phone number to local media where people can send SMS updates about their well-being. You can search for
            your loved one using their phone number below:
        </p>
    </div>

    <form
        class="mt-8"
        method="post"
        action="{{ route('search') }}"
    >

        @csrf

        <div class="max-w-lg" x-data>
            <x-input
                required
                x-mask="999-999-9999"
                label="Phone Number"
                name="phone_number"
                type="tel"
                inputmode="tel"
                placeholder="eg. 828-555-1234"
            />

            <div class="flex justify-end mt-4">
                <x-button type="submit" size="lg">
                    Search
                </x-button>
            </div>
        </div>
    </form>

</x-app-layout>

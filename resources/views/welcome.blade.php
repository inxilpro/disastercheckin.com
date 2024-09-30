<x-app-layout>

    <div class="prose">
        <h1 class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="size-10 fill-red-500">
                <path
                    d="M224 432c61.8 0 116.1-31.8 147.5-80l54.9 0c-36 75.7-113.1 128-202.4 128C100.3 480 0 379.7 0 256S100.3 32 224 32c118.3 0 215.2 91.8 223.4 208l-48.2 0C391.2 150.3 315.8 80 224 80C126.8 80 48 158.8 48 256s78.8 176 176 176zm0-304c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-112c0-13.3 10.7-24 24-24zM192 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM478 224c-2.1-16.5-5.7-32.6-10.8-48l76.7 0c26.5 0 48-21.5 48-48s-21.5-48-48-48l-40 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l40 0c53 0 96 43 96 96s-43 96-96 96l-66 0zm-6 256c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0c30.9 0 56-25.1 56-56s-25.1-56-56-56l-192 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l192 0c57.4 0 104 46.6 104 104s-46.6 104-104 104l-64 0z"/>
            </svg>
            Disaster Check-In
        </h1>

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
        </div>

        <div class="mt-2">
            <x-button type="submit" size="lg">
                Search
            </x-button>
        </div>
    </form>

</x-app-layout>

<x-app-layout>
    <h1>Disaster Check-In</h1>
    <p>If you are looking for information on a loved one, they may have checked in with us. We have provided a phone number to local media where people can send SMS updates about their well-being. You can search for your loved on by your user's phone number below:</p>
    <form method="post" action="{{ route('search') }}">
        @csrf
        <label for="phone_number">Phone Number</label>
        <input name="phone_number" id="phone_number" type="tel" inputmode="tel" placeholder="+18285551234">
        <button type="submit">Search</button>
    </form>
</x-app-layout>

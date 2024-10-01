<?php

use App\Models\Subscription;
use App\Models\User;
use Thunk\Verbs\Facades\Verbs;

use function Pest\Laravel\post;

it('you can search and include an email for notifications', function () {
    $response = post(route('subscribe'), [
        'phone_number' => '+12024561111',
        'email' => 'john@thunk.gov',
    ]);

    $response->assertRedirect(route('phone-number', '+12024561111'));

    Verbs::commit();

    $user = User::where('email', 'john@thunk.gov')->sole();

    $subscribed_phone_numbers = $user->subscriptions
        ->pluck('phone_number')
        ->map(e164(...));

    expect($subscribed_phone_numbers)->toHaveCount(1)
        ->first()->toBe('+12024561111');
});
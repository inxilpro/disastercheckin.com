<?php

use App\Models\PhoneNumber;
use App\Models\Subscription;
use App\Models\User;

use function Pest\Laravel\post;

it('you can search without providing an email', function () {
    $response = post(route('search'), [
        'phone_number' => '+12024561111',
    ]);

    $response->assertRedirect(route('phone-number', '+12024561111'));

    expect(User::count())->toBe(0)
        ->and(Subscription::count())->toBe(0)
        ->and(PhoneNumber::findByValue('+12024561111'))->toBeInstanceOf(PhoneNumber::class);
});

it('you can search and include an email for notifications', function () {
    $response = post(route('search'), [
        'phone_number' => '+12024561111',
        'email' => 'john@thunk.gov',
    ]);

    $response->assertRedirect(route('phone-number', '+12024561111'));

    $user = User::where('email', 'john@thunk.gov')->sole();

    $subscribed_phone_numbers = $user->subscriptions
        ->map(fn (Subscription $subscription) => e164($subscription->phone_number));

    expect($subscribed_phone_numbers)->toHaveCount(1)
        ->first()->toBe('+12024561111');
});

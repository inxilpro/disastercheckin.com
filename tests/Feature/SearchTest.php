<?php

use App\Models\PhoneNumber;
use App\Models\Subscription;
use App\Models\User;
use Thunk\Verbs\Facades\Verbs;

use function Pest\Laravel\post;

it('you can search', function () {
    $response = post(route('search'), [
        'phone_number' => '+12024561111',
    ]);

    $response->assertRedirect(route('phone-number', '+12024561111'));

    expect(User::count())->toBe(0)
        ->and(Subscription::count())->toBe(0)
        ->and(PhoneNumber::findByValue('+12024561111'))->toBeInstanceOf(PhoneNumber::class);
});

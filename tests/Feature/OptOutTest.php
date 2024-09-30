<?php

use App\Events\CheckedInViaSms;
use App\Models\CheckIn;
use App\Models\PhoneNumber;

use function Pest\Laravel\post;

it('allows opting out', function () {
    CheckedInViaSms::commit(
        phone_number: '+12024561111',
        update: 'This is my update',
        payload: [],
    );

    expect(CheckIn::count())->toBe(1);

    $response = post(route('webhooks.twilio'), [
        'From' => '+12024561111',
        'Body' => 'cancel',
    ]);

    $response->assertStatus(200);
    $response->assertSeeHtml('<Message>');
    $response->assertSee('removed');

    expect(CheckIn::count())->toBe(0)
        ->and(PhoneNumber::findByValueOrFail('+12024561111')->is_opted_out)->toBeTrue();
});

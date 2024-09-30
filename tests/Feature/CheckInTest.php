<?php

use App\Models\PhoneNumber;

use function Pest\Laravel\post;

it('allows checking in via Twilio webhooks', function () {
    $response = post(route('webhooks.twilio'), [
        'From' => '+12024561111',
        'Body' => 'UPDATE: We are safe and have enough food and water!',
    ]);

    $response->assertStatus(200);
    $response->assertSeeHtml('<Response>');
    $response->assertSeeHtml('<Message>');
    $response->assertSee('has been saved');

    $phone_number = PhoneNumber::findByValueOrFail('+12024561111');

    $check_in = $phone_number->check_ins()->latest()->first();

    expect($check_in->body)->toBe('We are safe and have enough food and water!');
});

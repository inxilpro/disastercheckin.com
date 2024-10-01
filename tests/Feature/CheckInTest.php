<?php

use App\Jobs\SendSubscribedNotificationsJob;
use App\Models\PhoneNumber;

use Illuminate\Support\Facades\Queue;
use function Pest\Laravel\post;

it('allows checking in via Twilio webhooks', function () {
    Queue::fake();

    $response = post(route('webhooks.twilio'), [
        'From' => '+12024561111',
        'Body' => 'UPDATE: We are safe and have enough food and water!',
    ]);

    $response->assertStatus(200);
    $response->assertSeeHtml('<Response>');
    $response->assertSeeHtml('<Message>');
    $response->assertSee('has been saved');

    Queue::assertPushed(SendSubscribedNotificationsJob::class);

    $phone_number = PhoneNumber::findByValueOrFail('+12024561111');

    $check_in = $phone_number->check_ins()->latest()->first();

    expect($check_in->body)->toBe('We are safe and have enough food and water!');
});

it('only sends one notification per two minutes', function () {
    Queue::fake();

    /**
     * FIRST CHECK IN
     */
    $response1 = post(route('webhooks.twilio'), [
        'From' => '+12024561111',
        'Body' => 'UPDATE: We are safe and have enough food and water!',
    ]);

    $response1->assertStatus(200);
    $response1->assertSeeHtml('<Response>');
    $response1->assertSeeHtml('<Message>');
    $response1->assertSee('has been saved');

    Queue::assertPushed(SendSubscribedNotificationsJob::class);

    $phone_number1 = PhoneNumber::findByValueOrFail('+12024561111');

    $check_in1 = $phone_number1->check_ins()->latest()->first();

    expect($check_in1->body)->toBe('We are safe and have enough food and water!');

    // Seems to be getting rate limited without this?
    sleep(1);

    /**
     * SECOND CHECK IN
     */
    $response2 = post(route('webhooks.twilio'), [
        'From' => '+12024561111',
        'Body' => 'UPDATE: We are safe and have shelter!',
    ]);

    $response2->assertStatus(200);
    $response2->assertSeeHtml('<Response>');
    $response2->assertSeeHtml('<Message>');
    $response2->assertSee('has been saved');

    Queue::assertPushed(SendSubscribedNotificationsJob::class);

    $phone_number2 = PhoneNumber::findByValueOrFail('+12024561111');

    $check_in2 = $phone_number2->check_ins()->latest()->first();

    expect($check_in2->body)->toBe('We are safe and have shelter!')
        ->and(Queue::size())->toBe(1);
});

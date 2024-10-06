<?php

use App\Events\SubmittedFyi;
use App\Jobs\SendToDiscord;
use Illuminate\Support\Facades\Queue;

test('you can submit resource information to discord', function () {
    Queue::fake();

    config()->set('discord.webhooks.default', 'https://some-test-site.com/webhook');

    SubmittedFyi::commit(
        phone_number: '+12024561111',
        message: 'Some information for you',
        payload: [],
    );

    Queue::assertPushed(SendToDiscord::class);
});


test('it will fail the job if the webhook does not exist', function () {
    Queue::fake();

    $job = (new SendToDiscord(
        message: "test",
        channel: 'wrong-channel'
    ))->withFakeQueueInteractions();

    $job->handle();

    $job->assertFailed();
});

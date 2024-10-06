<?php

namespace App\Console\Commands;

use App\Http\Controllers\Webhooks\TwilioWebhookController;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;


class FakeSms extends Command
{
    protected $signature = 'fake:sms {message}';

    protected $description = 'Sends a fake SMS.';

    public function handle()
    {
        config(['running_fake_sms_command' => true]);

        $from = '+14438259274';
        $body = $this->argument('message');

        $request = Request::create(
            uri: $this->prepareUrlForRequest(route('webhooks.twilio')),
            method: 'POST',
        )->merge([
            'From' => $from,
            'Body' => $body,
        ]);

        (new TwilioWebhookController())($request);
    }

    protected function prepareUrlForRequest($uri)
    {
        if (str_starts_with($uri, '/')) {
            $uri = substr($uri, 1);
        }

        return trim(url($uri), '/');
    }
}

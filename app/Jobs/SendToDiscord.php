<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/** @method static PendingDispatch dispatch(string $message, string $channel = 'default') */
class SendToDiscord implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $message,
        public string $channel = 'default'
    ){}

    public function handle(): void
    {
        $url = config("discord.channels.{$this->channel}");

        if(empty($url)) {
            Log::error("Discord channel [{$this->channel}] not configured");
            $this->fail("Discord channel [{$this->channel}] not configured");
            return;
        }

        $payload = [
            'content' => $this->message,
        ];

        Http::post($url, $payload);
    }
}

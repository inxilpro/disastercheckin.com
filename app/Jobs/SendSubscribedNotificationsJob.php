<?php

namespace App\Jobs;

use App\Mail\CheckInNotificationMail;
use App\Models\PhoneNumber;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendSubscribedNotificationsJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public PhoneNumber $phone_number,
    )
    {
    }

    public function uniqueId(): string
    {
        return $this->phone_number->id;
    }

    public function handle(): void
    {
        $check_ins = $this->phone_number->not_notified_check_ins()->get();

        if ($check_ins->count()) {
            $this->phone_number->subscriptions()
                ->each(function (Subscription $subscription) use ($check_ins) {
                    Mail::to($subscription->user->email)->send(
                        new CheckInNotificationMail(
                            check_ins: $check_ins,
                            phone_number: $this->phone_number
                        )
                    );

                    Log::info("Sent notification to {$subscription->user->email}");
                });

            foreach($check_ins as $check_in) {
                $check_in->update(['notifications_sent_at' => now()]);
            }
        }
    }
}

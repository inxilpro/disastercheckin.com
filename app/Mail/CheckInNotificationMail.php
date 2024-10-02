<?php

namespace App\Mail;

use App\Models\PhoneNumber;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckInNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Collection $check_ins,
        public PhoneNumber $phone_number,
    )
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Check In Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.check-in-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

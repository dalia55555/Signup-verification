<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerficationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $verificationCode;
    private string $name;

    /**
     * Create a new message instance.
     */
    public function __construct(string $name,string $verificationCode)
    {
        $this->verificationCode = $verificationCode;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verfication Code Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.verificationCode',
            with: ['NAME'=> $this->name, "CODE"=> $this->verificationCode]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

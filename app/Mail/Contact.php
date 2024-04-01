<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public readonly array $data)
    {
        
    }

    /**
     * Get the message envelope.
     */ public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->data['fromEmail'], $this->data['fromEmail']),
            subject: $this->data['subject'],
        //     replyTo:[
        //         new Address($this->data['fromEmail'], $this->data['fromEmail'])
        //          new Address($this->data['fromEmail'], $this->data['fromEmail'])
        //    ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
           html: 'site.contact-message',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        //var_dump($this->data['attachments']->getPathname());
        //die();
        $data = $this->data['attachments'];
        return [
            Attachment::fromPath($data->getPathname())->as($data->getClientOriginalName())
            ->withMime($data->getMimeType()),
        ];
    }

}

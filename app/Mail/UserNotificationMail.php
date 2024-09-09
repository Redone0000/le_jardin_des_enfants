<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $name;
    public $emailSender;
    public $subject;
    public $content;
    public $nameSender;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $emailSender, $subject, $content, $nameSender)
    {
        $this->name = $name;
        $this->emailSender = $emailSender;
        $this->subject = $subject;
        $this->content = $content;
        $this->nameSender = $nameSender;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
            from: $this->emailSender
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.userContact',
            with: [
                'content' => $this->content,
                'url' => null, // Laissez cette valeur si vous n'avez pas de bouton dans l'email
            ]
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

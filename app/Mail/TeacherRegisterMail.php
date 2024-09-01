<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeacherRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $login;
    public $lastname;
    public $firstname;
    public $email;
    public $password;
    public $phone;
    public $description;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $login, $password)
    {
        $this->login = $login;
        $this->lastname = $data['lastname'];
        $this->firstname = $data['firstname'];
        $this->email = $data['email'];
        $this->password = $password;
        $this->phone = $data['phone'];
        $this->description = $data['description'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Inscription enseignant',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.TeacherRegister',
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

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChildRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $classe;
    public $lastname;
    public $firstname;
    public $sexe;
    public $birth_date;
    public $firstname_tutor;
    public $lastname_tutor;
    public $email;
    public $phone;
    public $address;
    public $password;
    public $emergency_contact_name;
    public $emergency_contact_phone;

    /**
     * Create a new message instance.
     */
    public function __construct($data,$password, $classe)
    {
        $this->classe = $classe;
        $this->lastname = $data['lastname'];
        $this->firstname = $data['firstname'];
        $this->sexe = $data['sexe'];
        $this->birth_date = $data['birth_date'];
        $this->firstname_tutor = $data['firstname_tutor'];
        $this->lastname_tutor = $data['lastname_tutor'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->password = $password;
        $this->emergency_contact_name = $data['emergency_contact_name'];
        $this->emergency_contact_phone = $data['emergency_contact_phone'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Inscription de votre enfant',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.ChildRegister',
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

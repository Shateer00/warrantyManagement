<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     private $name;
     private $email;
     private $applicationName;


    public function __construct($Email,$applicationName,$name)
    {
        $this->email = $Email;
        $this->name = $name;
        $this->applicationName = $applicationName;
        $this->emailRegisterNotification = env('NOTIF_MAIL_EMAIL');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from( $this->emailRegisterNotification)
                   ->view('emailTemplateRegister')
                   ->with(
                    [
                        'name' => $this->name,
                        'email' => $this->email,
                        'applicationName' => $this->applicationName
                    ]);
    }
}
    
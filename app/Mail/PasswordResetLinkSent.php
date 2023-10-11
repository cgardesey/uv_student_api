<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetLinkSent extends Mailable
{
    use Queueable, SerializesModels;

    public $password_reset;

    /**
     * Create a new message instance.
     *
     * @param $info
     */
    public function __construct($password_reset)
    {
        $this->password_reset = $password_reset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.password-reset-link-sent');
    }
}

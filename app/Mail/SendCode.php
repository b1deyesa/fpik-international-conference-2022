<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $name;
    public $access_code; 
    public function __construct(
        $name        = 'User',
        $access_code = 'Regist again'
    )
    {
        $this->name        = $name;
        $this->access_code = $access_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('ICSBE Access Code')
                    ->view('mails.send-code');
    }
}

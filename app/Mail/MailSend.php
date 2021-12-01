<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;

    public $mail_text;
    public $title;
    public $name;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $title, $mail_text)
    {
        $this->name = $name;
        $this->title = $title;
        $this->mail_text = $mail_text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@cab-station.com')
                    ->view('emails.all_send')
                    ->subject('件名が入ります');
    }
}

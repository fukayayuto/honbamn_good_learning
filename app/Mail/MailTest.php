<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailTest extends Mailable
{
    use Queueable, SerializesModels;

    public $mail_text;
    public $m_user_name  = '';
    public $m_company_name  = '';
    public $m_reservation_date = '';
    public $m_reservation_count = 0;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_text, $user_name, $company_name, $reservation_date, $reservation_count)
    {
        $this->mail_text = $mail_text;
        $this->m_user_name = $user_name;
        $this->m_company_name = $company_name;
        $this->m_reservation_date = $reservation_date;
        $this->m_reservation_count = $reservation_count;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('e-learning@example.com')
                    ->view('emails.test')
                    ->subject('登録完了');
    }
}

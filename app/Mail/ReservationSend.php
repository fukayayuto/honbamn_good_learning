<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationSend extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $company_name;
    public $sales_office;
    public $phone;
    public $reservation_name;
    public $count;
    public $start_date;
    public $progress;
        
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $company_name, $sales_office, $phone, $reservation_name, $count, $start_date, $progress)
    {
        $this->name = $name;
        $this->email = $email;
        $this->company_name = $company_name;
        $this->sales_office = $sales_office;
        $this->phone = $phone;
        $this->reservation_name = $reservation_name;
        $this->count = $count;
        $this->start_date = $start_date;
        $this->progress = $progress;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //以下追記
        return $this->view('emails.reservation')
                    ->from('info@cab-station.com')
                    ->subject('予約完了メールの送信');
    }
}

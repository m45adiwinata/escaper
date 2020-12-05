<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Checkout;

class EscaperEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = Checkout::first();
        $temp = array(
            'email' => $data->email,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'guest_code' => $data->guest_code
        );
        return $this->from('info.escaper@gmail.com')
                ->view('emailku', $temp)
                ->subject('Purchase '.$temp['guest_code']);
    }
}

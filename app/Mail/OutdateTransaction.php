<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OutdateTransaction extends Mailable
{
    use Queueable, SerializesModels;
    protected $trx;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trx)
    {
        $this->trx = $trx;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'))
                    ->subject('Your Outdate Transaction')
                    ->view('email/outdate_transaction')
                    ->with([
                        'data' => $this->trx
                    ]);
    }
}

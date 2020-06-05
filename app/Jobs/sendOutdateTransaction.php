<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\OutdateTransaction;
use Illuminate\Support\Facades\Mail;

class sendOutdateTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $transaksi;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new OutdateTransaction($this->transaksi);
        Mail::to($this->transaksi->user->email)->send($email);
    }
}

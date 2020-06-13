<?php

namespace App\Jobs;

use App\Mail\RegistrasiConfirm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class sendRegistrationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $id)
    {
        $this->email = $email;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new RegistrasiConfirm($this->id);
        Mail::to($this->email)->send($email);
    }
}

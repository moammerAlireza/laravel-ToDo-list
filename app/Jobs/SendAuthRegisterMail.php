<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAuthRegisterMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $first_name;
    private $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($first_name, $email)
    {
        $this->first_name = $first_name;
        $this->email = $email;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('mails.auth-register', ["first_name" => $this->first_name], function ($message) {
            $message->to($this->email)->subject('welcome');
        });
    }
}

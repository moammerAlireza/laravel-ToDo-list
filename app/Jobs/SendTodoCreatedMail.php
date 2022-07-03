<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTodoCreatedMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $title;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->title=$title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('mails.todo-created',['todoTitle'=>$this->title], function ($message){
            $message->to('moameralireza@gmail.com')->subject('New Todo');
        });
    }
}

<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $emailAddress;

    /**
     * Create a new job instance.
     *
     * @param $emailAddress
     */
    public function __construct($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send('emails.welcome', [], function($message) {
            $message->from(env('MAIL_FROM'), 'Queue Test Sender');
            $message->to($this->emailAddress)->subject('Welcome Email');
        });
    }
}

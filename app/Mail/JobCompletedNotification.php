<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobCompletedNotification extends Mailable
{
    use Queueable, SerializesModels;
    protected $jobCompleted;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($jobCompleted)
    {
        $this->jobCompleted = $jobCompleted;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@oandbservices.com','O & B Services')
                    ->subject('Job Completion')
                    ->markdown('mails.job-completed-user-notification')->with([

                        'customerName' => $this->jobCompleted['customer_name'],
                    ]);
    }
}

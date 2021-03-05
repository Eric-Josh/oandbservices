<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobPostUserNotification extends Mailable
{
    use Queueable, SerializesModels;
    private $customerName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@oandbservices.com','O & B Services')
                    ->subject('New Job Post')
                    ->markdown('mails.jobpost-user-notification')
                    ->with([
                        'customerName' => $this->customerName['customer_name'],
                    ]);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobAssignUserNotification extends Mailable
{
    use Queueable, SerializesModels;
    protected $customerData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerData)
    {
        $this->customerData = $customerData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@oandbservices.com','O & B Services')
        ->subject('Assigned Job')
        ->markdown('mails.job-assign-user-notification')->with([
            'customerName' => $this->customerData['customer_name'],
            'handymanName' => $this->customerData['handyman_name'],
            'handymanPhone' => $this->customerData['phone_number'],
        ]);
    }
}

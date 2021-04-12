<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MerchandiseUpdateAdminNotification extends Mailable
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
                    ->subject('Merchandise - Update on Job Post')
                    ->markdown('mails.merchndise-update-admin-notification')
                    ->with([
                        'customerName'=>$this->customerData['customer_name'],
                        'customerEmail' => $this->customerData['customer_email'],
                        'customerPhone' => $this->customerData['customer_phone'],
                        'merchandiseType'=>$this->customerData['merchanddise_type'],
                        'jobDesc' => $this->customerData['job_desc'],
                        'jobLoc' => $this->customerData['job_loc'],
                        'jobAmount' => $this->customerData['job_amount'],
                        'jobStartTime' => $this->customerData['job_start_time'],
                    ]);
    }
}

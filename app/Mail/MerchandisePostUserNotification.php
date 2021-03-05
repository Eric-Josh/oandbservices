<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MerchandisePostUserNotification extends Mailable
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
                    ->subject('Merchandise - New Job Post')
                    ->markdown('mails.merchandise-user-notification')
                    ->with([
                        'customerName'=>$this->customerData['customer_name'],
                        'merchandiseType'=>$this->customerData['merchanddise_type'],
                    ]);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobAssignHandymanNotification extends Mailable
{
    use Queueable, SerializesModels;
    protected $handymanData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($handymanData)
    {
        $this->handymanData = $handymanData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('no-reply@oandbservices.com','O & B Services')
        ->subject('New Assigned Job')
        ->markdown('mails.job-assign-handyman-notification')->with([
            'handymanName' => $this->handymanData['handyman_name'],
            'customerName' => $this->handymanData['customer_name'],
            'customerPhone' => $this->handymanData['customer_phone'],
            'jobTitle' => $this->handymanData['job_title'],
            'jobDesc' => $this->handymanData['job_desc'],
            'jobLocation' => $this->handymanData['job_location'],
            'jobAmount' => $this->handymanData['job_amount'],
        ]);

        foreach(explode('|', $this->handymanData['job_snippet'] ) as $files){
            $attach = public_path('job-images').'/'. $files;
            $mail->attach($attach);
        }

        return $mail;
    }
}

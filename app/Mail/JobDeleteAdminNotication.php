<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobDeleteAdminNotication extends Mailable
{
    use Queueable, SerializesModels;
    private $jobDataAdmin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($jobDataAdmin)
    {
        $this->jobDataAdmin = $jobDataAdmin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('no-reply@oandbservices.com','O & B Services')
        ->subject('Deleted Job Post')
        ->markdown('mails.job-delete-admin-notification')
        ->with([
            'customerName' => $this->jobDataAdmin['customer_name'],
            'customerEmail' => $this->jobDataAdmin['customer_email'],
            'customerPhone' => $this->jobDataAdmin['customer_phone'],
            'jobTitle' => $this->jobDataAdmin['job_title'],
            'jobDesc' => $this->jobDataAdmin['job_desc'],
            'jobLoc' => $this->jobDataAdmin['job_location'],
            'jobAmount' => $this->jobDataAdmin['job_amount'],
            'jobStartTime' => $this->jobDataAdmin['job_start_time'],
        ]);

        foreach(explode('|', $this->jobDataAdmin['job_snippet'] ) as $files){
            $attach = public_path('job-images').'/'. $files;
            $mail->attach($attach);
        }

        return $mail;
    }
}

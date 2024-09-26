<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Certification;

class notificationEmail extends Mailable 
{
    use Queueable, SerializesModels;

    /**
     * The data instance.
     *
     * @var Data
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {  
        $mail = $this->from(env('MAIL_FROM'), 'Info DrFixit')
                    ->subject($this->data->subject)
                    ->view('emails.notification');
                    if (isset($this->data->file_path) && $this->data->file_path != "") {
                        $mail = $mail->attach($this->data->file_path);
                    }

        return $mail;
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportMail extends Mailable
{
    use Queueable, SerializesModels;
      public $name,$email,$title,$content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$title,$email,$content)
    {
        $this->name=$name;
        $this->title=$title;
        $this->email=$email;
        $this->content=$content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.support');
    }
}

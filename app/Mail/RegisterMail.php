<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $password;
    public $link;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $password,$link, $name)
    {
        $this->username = $username;
        $this->password = $password;
        $this->link =$link;
        $this->name =$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->
            from('tonybaba7000@gmail.com')->
            view('mail.register');
    }
}

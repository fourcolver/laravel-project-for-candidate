<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendFreelancerMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $users_mail_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        //
        $users = \DB::table('users')->select('first_name','last_name', 'email')->where('id',$mail_data)->first();
        $this->users_mail_data = $users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.mail_template')
        ->with([
            'users_mail_data' => $this->users_mail_data
        ]);
    }
}

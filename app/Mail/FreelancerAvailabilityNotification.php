<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FreelancerAvailabilityNotification extends Mailable
{
    use Queueable, SerializesModels;
    private $user;

    /**
     * FreelancerAvailabilityNotification constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(config('app.name') . ': Availability request')
            ->markdown('emails.freelancer.availabilityNotification', [
                'user' => $this->user
            ]);
    }
}

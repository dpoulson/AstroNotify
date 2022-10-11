<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClearNight extends Mailable
{
    use Queueable, SerializesModels;
    
    public $results;
    public $user;
    public $requirement_id;
    public $location;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($requirement, $results, \App\User $user, \App\Location $location)
    {
        $this->results        = $results;
        $this->user           = $user;
        $this->requirement    = $requirement;
        $this->location       = $location;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.clearnight');
    }
}

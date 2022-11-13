<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuzonMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $sugerencia;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sugerencia)
    {
     $this->sugerencia = $sugerencia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.bmail');
    }
}

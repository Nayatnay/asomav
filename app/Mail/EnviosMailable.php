<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviosMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $envio;


    public function __construct($envio)
    {
     $this->envio = $envio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.envios');
    }
}

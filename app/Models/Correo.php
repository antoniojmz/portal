<?php

namespace App\Models;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;

class Correo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $data;

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
        return $this->view('auth.emails.reinicioClave')
            ->subject($this->data['subject'])
            ->with([
                'header' => $this->data['header'],
                'footer' => $this->data['footer'],
                'usrNombreFull' => $this->data['usrNombreFull'],
                'pass' => $this->data['pass'],
            ]);
    }
}
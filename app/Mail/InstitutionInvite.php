<?php

namespace App\Mail;

use App\Institution;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InstitutionInvite extends Mailable
{
    use Queueable, SerializesModels;

    protected $institution;
    protected $pass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Institution $institution, $pass)
    {
        $this->institution = $institution;
        $this->pass = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.institutionInvite')->with([
            'name' => $this->institution->name,
            'pass' => $this->pass
        ]);
    }
}

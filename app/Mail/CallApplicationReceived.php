<?php

namespace App\Mail;

use App\Models\Call;
use App\Models\Organisation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CallApplicationReceived extends Mailable
{
    use Queueable, SerializesModels;

    protected $call, $applicantOrg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Call $call, Organisation $applicantOrg)
    {
        $this->call = $call;
        $this->applicantOrg = $applicantOrg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Application for call received')->markdown('emails.calls.call-signup-received',['receiver_org_name'=>$this->call->organisation->organisation_name,'call_title'=>$this->call->title,'applicant_org_name'=>$this->applicantOrg->organisation_name]);
    }
}

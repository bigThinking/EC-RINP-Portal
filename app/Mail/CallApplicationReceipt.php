<?php

namespace App\Mail;

use App\Models\Call;
use App\Models\Organisation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CallApplicationReceipt extends Mailable
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
        return $this->subject('Call application receipt')->markdown('emails.signups.receipt',['call_title'=>$this->call->title,'org_name'=>$this->applicantOrg->organisation_name]);
    }
}

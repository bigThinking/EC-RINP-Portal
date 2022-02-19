<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $admin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $newUser, User $admin)
    {
        $this->user = $newUser;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Portal SignUp')->markdown('emails.signup.approve-user',['admin_name'=>$this->admin->title.' '.$this->admin->surname,'username'=>$this->user->title.' '.$this->user->name.' '.$this->user->surname, 'email'=> $this->user->email,
         'organisation'=> $this->user->organisation->organisation_name, 'is_innovator'=> $this->user->is_innovator, 'job_title'=>$this->user->job_title]);
    }
}

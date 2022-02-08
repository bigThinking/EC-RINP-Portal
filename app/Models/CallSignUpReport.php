<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallSignUpReport extends BaseModel
{
    protected $fillable = ['call_sign_up_id','report','last_edited_by_user_id'];


    public function callSignUp(){
        return $this->belongsTo(CallSignUp::class, 'call_sign_up_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'last_edited_by_user_id');
    }
}
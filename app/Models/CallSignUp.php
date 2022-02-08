<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallSignUp extends BaseModel
{
    protected $fillable = ['call_id','user_id','user_organisation_id'];


    public function call(){
        return $this->belongsTo(Call::class, 'call_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organisation(){
        return $this->belongsTo(Organisation::class, 'user_organisation_id');
    }

    public function callSignUpReport()
    {
        return $this->hasOne(CallSignUpReport::class, 'call_sign_up_id');
    }
}
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
}
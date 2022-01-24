<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends BaseModel
{
    protected $fillable = ['title','description','call_type','organisation_id',
        'closing_date','start_time','end_time'];


    public function organisaton(){
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }

    public function callSignUp(){
        return $this->hasMany(CallSignUp::class, 'call_id');
    }
}
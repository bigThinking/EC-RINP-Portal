<?php

namespace App\Models;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends BaseModel
{
    protected $fillable = ['organisation_name','description','reg_no','location',
        'email','website','contact_number', 'logo_url'];

    public function user(){
        return $this->hasMany(User::class, 'organisation_id');
    }

    public function project(){
        return $this->hasOne(Project::class, 'organisation_id');
    }

    public function call(){
        return $this->hasMany(Call::class, 'organisation_id');
    }

    public function callSignUp(){
        return $this->hasMany(callSignUp::class, 'user_organisation_id');
    }
}

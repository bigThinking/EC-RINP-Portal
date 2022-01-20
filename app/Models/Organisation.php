<?php

namespace App\Models;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends BaseModel
{
    protected $fillable = ['organisation_name','description','reg_no','location',
        'email','website','contact_number'];

    public function user(){
        return $this->hasMany(User::class, 'organisation_id');
    }

    public function call(){
        return $this->hasMany(Call::class, 'organisation_id');
    }
}

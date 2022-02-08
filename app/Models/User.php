<?php

namespace App\Models;

use App\Models\Role;
use App\Traits\Uuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use Uuids;

    protected $keyType = 'string';
    protected $guard_name = 'web';
    public $incrementing = false;

    protected $fillable = [
        'name', 'email', 'password', 'is_approved', 'surname','contact_number','role_id','description','address',
        'organisation_id','title','job_title','personal_profile','race','gender',
        'is_innovator','project_id'
    ];

    public function organisation(){
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_users', 'user_id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

    public function task(){
        return $this->hasMany(Task::class,'user_id');
    }

    public function callSignUp(){
        return $this->hasMany(callSignUp::class, 'user_id');
    }

    public function callSignUpReport(){
        return $this->hasMany(callSignUpReport::class, 'last_edited_by_user_id');
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

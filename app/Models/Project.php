<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends BaseModel
{
   protected $fillable = ['project_name','description','memberName','project_stage_id','start_date',
       'end_date','stage_description','progress_summary','graduation_date','organisation_id','graduation_id',
       'project_closed'];

    public function user(){
        return $this->HasMany(User::class, 'project_id');
    }

    public function stages(){
        return $this->HasMany(ProjectStage::class, 'project_id');
    }

    public function organisation(){
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }

    public function graduation(){
        return $this->belongsTo(GraduationStage::class, 'graduation_id');
    }

    public function projectstages(){
        return $this->HasMany(Stage::class, 'project_id');
    }

    public function task(){
        return $this->HasMany(Task::class, 'project_id');
    }
}

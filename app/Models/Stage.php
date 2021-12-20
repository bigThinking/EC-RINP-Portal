<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends BaseModel
{
    protected $fillable = ['start_date','end_date','stage_description','trl',
        'project_stage_id','project_id','task_id','graduation_id','stageClosed'];

    public function projectStages(){
        return $this->belongsTo(ProjectStage::class, 'project_stage_id');
    }
    public function project(){
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function graduation(){
        return $this->hasMany(GraduationStage::class, 'stage_id');
    }

    public function task(){
        return $this->hasMany(Task::class, 'stage_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStage extends BaseModel
{
    protected $fillable = ['project_stage','project_id'];

    public function projects(){
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function stageProject(){
        return $this->hasMany(Stage::class, 'project_stage_id');
    }

    public function task(){
        return $this->hasMany(Task::class, 'project_stage_id');
    }

    public function graduate(){
        return $this->hasMany(GraduationStage::class, 'project_stage_id');
    }
}

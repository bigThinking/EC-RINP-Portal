<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationStage extends BaseModel
{
    protected $fillable = ['previous_stage','next_stage_name','progress_summary','graduation_date',
        'project_stage_id','stage_id','project_id','project_name','stageGraduated'];

    public function projects(){
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function projectStage(){
        return $this->belongsTo(ProjectStage::class, 'project_stage_id');
    }

    public function stage(){
        return $this->belongsTo(Stage::class, 'stage_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends BaseModel
{
    protected $fillable = ['title','description','isClosed','isDone',
        'last_updated_date','user_id','closing_report',
        'date_closed','project_stage_id','project_id','stage_id','project_name','is_replied',
        'project_description'];


    public function projects(){
        return $this->belongsTo(Project::class, 'task_id');
    }

    public function projectsStage(){
        return $this->belongsTo(ProjectStage::class, 'project_stage_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function taskReply(){
        return $this->hasMany(TaskReply::class, 'task_id');
    }
    public function stage(){
        return $this->belongsTo(Stage::class, 'stage_id');
    }

}

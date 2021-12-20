<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReply extends BaseModel
{
    protected $fillable =['task_id','user_id','reply'];

    public function task(){
        return $this->belongsTo(Task::class, 'task_id');
    }
}

<?php
namespace App\Models;

use DateTime;

class Timeline
{
    public const STAGE_TYPE = 0;
    public const GRADUATION_TYPE = 1;
    public const CALL_TYPE = 2;
    public const TASK_TYPE = 3;
    public $task, $callSignUps, $stage, $graduation;
    public ?Timeline $next = null;
    public $type = -1;
    public ?DateTime $top_date = null;

    private function __construct()
    {
        $tasks = null;
        $callSignUps = null;
        $stage = null;
        $graduation = null;
    }

    public static function makeStage($stage)
    {
        $obj = new Timeline();
        $obj->stage = $stage;
        $obj->type = Timeline::STAGE_TYPE;
        $obj->top_date = $stage->created_at;
        return $obj;
    }

    public static function makeTask($task)
    {
        $obj = new Timeline();
        $obj->task = $task;
        $obj->type = Timeline::TASK_TYPE;
        $obj->top_date = $task->created_at;
        return $obj;
    }

    public static function makeGraduation($graduation)
    {
        $obj = new Timeline();
        $obj->graduation = $graduation;
        $obj->type = Timeline::GRADUATION_TYPE;
        $obj->top_date = $graduation->created_at;
        return $obj;
    }

    public static function makeCall($callSignUps)
    {
        $obj = new Timeline();
        $obj->callSignUps = $callSignUps;
        $obj->type = Timeline::CALL_TYPE;
        $obj->top_date = $callSignUps[0]->created_at;
        return $obj;
    }
}

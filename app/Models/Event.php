<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelFullCalendar\Facades\Calendar;

class Event extends BaseModel implements  \LaravelFullCalendar\Event
{
    public $table = "events";
    protected $fillable = ['title','start','end','type',
        'start_time','end_time','all_day'];


    public function getId() {
        return $this->id;
    }
    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @inheritDoc
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * @inheritDoc
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @inheritDoc
     */
    public function getEnd()
    {
        return $this->end;
    }
}

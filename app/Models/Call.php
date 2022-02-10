<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelFullCalendar\Facades\Calendar;

class Call extends BaseModel implements  \LaravelFullCalendar\Event
{
    protected $fillable = ['title','description','call_type','organisation_id',
        'closing_date','start_time','end_time', 'image_url'];


    public function organisation(){
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }

    public function callSignUp(){
        return $this->hasMany(CallSignUp::class, 'call_id');
    }

    public function callType(){
        return $this->belongsTo(CallType::class, 'call_type');
    }

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
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getStart()
    {
        return date('Y:m:d', strtotime($this->start_time));
    }

    /**
     * @inheritDoc
     */
    public function getEnd()
    {
        return date('Y:m:d', strtotime($this->end_time));
    }

    public function isEvent()
    {
        return $this->call_type == 'Event';
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordedStream extends Model
{
    protected $guarded = ['id', 'recordedstreamid'];
    protected $primaryKey = 'recordedstreamid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'recordedstreamid';
    }

    public function instructorCourse()
    {
        return $this->belongsTo(InstructorCourse::class,'instructorcourseid', 'instructorcourseid');
    }
}

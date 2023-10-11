<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecordedVideoStream extends Model
{
    protected $guarded = ['id', 'recordedvideostreamid'];
    protected $primaryKey = 'recordedvideostreamid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'recordedvideostreamid';
    }

    public function instructorCourse()
    {
        return $this->belongsTo(InstructorCourse::class,'instructorcourseid', 'instructorcourseid');
    }
}

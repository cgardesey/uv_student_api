<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordedVideo extends Model
{
    protected $guarded = ['id', 'livevideoid'];
    protected $primaryKey = 'livevideoid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'livevideoid';
    }

    public function instructorCourse()
    {
        return $this->belongsTo(InstructorCourse::class,'instructorcourseid', 'instructorcourseid');
    }
}

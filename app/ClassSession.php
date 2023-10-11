<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSession extends Model
{

    protected $guarded = ['id', 'classsessionid'];
    protected $primaryKey = 'classsessionid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $appends = ['nodeserver'];
    public function getRouteKeyName()
    {
        return 'courseid';
    }

    public function getNodeserverAttribute()
    {
        $instructor_course = InstructorCourse::find($this->instructorcourseid);
        if ($instructor_course) {
            return $instructor_course->nodeserver;
        }
        return '';
    }
}

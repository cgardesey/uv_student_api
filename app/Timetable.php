<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $guarded = ['id', 'timetableid'];
    protected $primaryKey = 'timetableid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'timetableid';
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructor_periods', 'periodid', 'instructorid', 'timetableid', 'infoid')
            ->using(InstructorPeriod::class)
            ->as('instructorPeriod')
            ->withPivot('id', 'instructorperiodid')
            ->withTimestamps();
    }

    public function instructorCourses()
    {
        return $this->belongsToMany(InstructorCourse::class, 'instructor_course_periods', 'periodid', 'instructorcourseid', 'timetableid', 'instructorcourseid')
            ->using(InstructorCoursePeriod::class)
            ->as('instructorCoursePeriod')
            ->withPivot('id', 'instructorcourseperiodid')
            ->withTimestamps();
    }
}

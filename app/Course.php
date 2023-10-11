<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id', 'courseid'];
    protected $primaryKey = 'courseid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = ['enrolment'];

    public function getRouteKeyName()
    {
        return 'courseid';
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructor_courses', 'courseid', 'instructorid', 'courseid', 'infoid')
            ->using(InstructorCourse::class)
            ->as('instructorCourse')
            ->withPivot('id', 'instructorcourseid')
            ->withTimestamps();
    }
}

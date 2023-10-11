<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $guarded=['id', 'infoid'];
    protected $primaryKey = 'infoid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = ['id', 'instructor_course'];

    public function getRouteKeyName()
    {
        return 'infoid';
    }

    public function user()
    {
        return $this->morphOne(User::class, null, 'role', 'infoid','userid');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'instructor_courses', 'instructorid', 'courseid', 'infoid', 'courseid')
            ->using(InstructorCourse::class)
            ->as('instructorCourse')
            ->withPivot('id', 'instructorcourseid')
            ->withTimestamps();
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'instructorid', 'infoid');
    }

    public function institutions()
    {
        return $this->belongsToMany(Institution::class, 'instructor_institutions', 'instructorid', 'institutionid', 'infoid', 'institutionid')
            ->using(InstructorInstitution::class)
            ->as('instructorInstitution')
            ->withPivot('id', 'instructorinstitutionid')
            ->withTimestamps();
    }
}

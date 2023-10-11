<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded=['id', 'infoid'];
    protected $primaryKey = 'infoid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = ['id', 'instructor_courses', 'submitted_assignments', 'attendances'];

    public function getRouteKeyName()
    {
        return 'infoid';
    }

    public function user()
    {
        return $this->morphOne(User::class, null, 'role', 'userid','infoid');
    }


    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'studentid','infoid');
    }

    public function instructorCourses()
    {
        return $this->belongsToMany(InstructorCourse::class, 'enrolments', 'studentid', 'instructorcourseid', 'infoid', 'instructorcourseid')
            ->using(Enrolment::class)
            ->as('enrolment')
            ->withPivot('id', 'enrolmentid', 'enrolled', 'enrolmentfeesexpirydate', 'percentagecompleted', 'connectedtoaudio', 'connectedtovideo', 'connectedtocall', 'connectedtochat')
            ->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'payerid', 'infoid');
    }

    public function submittedAssignments()
    {
        return $this->hasMany(SubmittedAssignment::class, 'studentid', 'infoid');
    }

    public function submittedQuizzes()
    {
        return $this->hasMany(SubmittedQuiz::class, 'studentid', 'infoid');
    }
}

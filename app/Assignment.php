<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class  Assignment extends Model
{
    protected $guarded = ['id', 'assignmentid'];
    protected $primaryKey = 'assignmentid';
    public $incrementing = false;
    protected $keyType = 'string';


    public function getRouteKeyName()
    {
        return 'assignmentid';
    }

    public function instructorCourse()
    {
        return $this->belongsTo(InstructorCourse::class,'instructorcourseid', 'instructorcourseid');
    }

    public function submittedAssignments()
    {
        return $this->hasMany(SubmittedAssignment::class, 'assignmentid', 'assignmentid');
    }
}

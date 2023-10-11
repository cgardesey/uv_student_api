<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmittedAssignment extends Model
{
    protected $guarded=['id', 'percentagescore'];
    protected $primaryKey = 'submittedassignmentid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'submittedassignmentid';
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid', 'infoid');
    }

    public function assignment()
    {
        return $this->hasMany(Assignment::class, 'assignmentid','assignmentid');
    }
}

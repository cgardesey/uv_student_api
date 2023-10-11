<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstructorCourseRating extends Model
{
    protected $guarded = ['id', 'instructorcourseratingid'];
    protected $primaryKey = 'instructorcourseratingid';
    public $incrementing = false;
    protected $keyType = 'string';

    public $table = "instructor_course_ratings";

    public function instructorCourse()
    {
        return $this->belongsTo(InstructorCourse::class, 'instructorcourseid', 'instructorcourseid');
    }
}

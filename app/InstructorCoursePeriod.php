<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class InstructorCoursePeriod extends Pivot
{
    protected $primaryKey = 'instructorcourseperiodid';
    public $incrementing = false;
    protected $keyType = 'string';

    public $table = "instructor_course_periods";
}

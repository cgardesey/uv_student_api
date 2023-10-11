<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InstructorInstitution extends Pivot
{
    protected $primaryKey = 'instructorinstitutionid';
    public $incrementing = false;
    protected $keyType = 'string';

    public $table = "instructor_institutions";
}

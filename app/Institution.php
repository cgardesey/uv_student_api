<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $guarded = ['id', 'institutionid'];
    protected $primaryKey = 'institutionid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'institutionid';
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructor_institutions', 'institutionid', 'instructorid', 'institutionid', 'infoid')
            ->using(InstructorInstitution::class)
            ->as('instructorInstitution')
            ->withPivot('id', 'instructorinstitutionid')
            ->withTimestamps();
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'institutionid', 'institutionid');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'institutionid', 'institutionid');
    }
}

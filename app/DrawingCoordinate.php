<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrawingCoordinate extends Model
{
    protected $guarded = ['id', 'coordinatesid'];
    protected $primaryKey = 'coordinatesid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'coordinatesid';
    }

    public function instructorCourse()
    {
        return $this->belongsTo(InstructorCourse::class,'instructorcourseid', 'instructorcourseid');
    }
}

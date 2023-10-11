<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Audio extends Model
{
    protected $guarded = ['id', 'audioid'];
    protected $primaryKey = 'audioid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'audioid';
    }

    public function instructorCourse()
    {
        return $this->belongsTo(Course::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'audioid','audioid');
    }
}

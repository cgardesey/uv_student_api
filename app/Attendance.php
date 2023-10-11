<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = ['id', 'attendanceid'];
    protected $primaryKey = 'attendanceid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'attendanceid';
    }

    public function audio()
    {
        return $this->belongsTo(Audio::class,'audioid', 'audioid');
    }

    public function student()
    {
        return $this->belongsTo(Student::class,'studentid', 'infoid');
    }
}

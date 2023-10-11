<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassAudioSession extends Model
{
    protected $guarded = ['id', 'classaudiosessionid'];
    protected $primaryKey = 'classaudiosessionid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $appends = ['dialcode', 'roomid', 'nodeserver'];


    public $table = "class_audio_sessions";

    public function getDialcodeAttribute()
    {
        $projectinfo = DB::table('project_info')->get()->first();
        if ($projectinfo) {
            return $projectinfo->dialcode;
        }
        return '';
    }

    public function getRoomidAttribute()
    {
        $instructor_course = InstructorCourse::find($this->instructorcourseid);
        if ($instructor_course) {
            return $instructor_course->room_number;
        }
        return '';
    }

    public function getNodeserverAttribute()
    {
        $instructor_course = InstructorCourse::find($this->instructorcourseid);
        if ($instructor_course) {
            return $instructor_course->nodeserver;
        }
        return '';
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassVideoSession extends Model
{
    protected $guarded = ['id', 'classvideosessionid'];
    protected $primaryKey = 'classvideosessionid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $appends = ['dialcode', 'roomid', 'nodeserver'];


    public $table = "class_video_sessions";

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

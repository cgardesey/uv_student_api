<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Log;

class InstructorCourse extends Pivot
{
    protected $guarded = ['id', 'instructorcourseid'];
    protected $primaryKey = 'instructorcourseid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $appends = ['total_ratings', 'onestar_count', 'twostar_count', 'threestar_count', 'fourstar_count', 'fivestar_count', 'rating'];

    protected $hidden = ['ratings'];

    public $table = "instructor_courses";

//    protected $hidden = ['enrolment', 'assignments', 'audios', 'course', 'instructor', 'quizzes',  'chats, ratings'];

    public function getOnestarCountAttribute()
    {
        $onestar = 0;
        if ($this->ratings->count() > 0) {
            foreach ($this->ratings as $rating) {
                $onestar += (int)$rating->onestar;
            }
            return $onestar;
        } else return 0;
    }

    public function getTwostarCountAttribute()
    {
        $twostar = 0;
        if ($this->ratings->count() > 0) {
            foreach ($this->ratings as $rating) {
                $twostar += (int)$rating->twostar;
            }
            return $twostar;
        } else return 0;
    }

    public function getThreestarCountAttribute()
    {
        $threestar = 0;
        if ($this->ratings->count() > 0) {
            foreach ($this->ratings as $rating) {
                $threestar += (int)$rating->threestar;
            }
            return $threestar;
        } else return 0;
    }

    public function getFourstarCountAttribute()
    {
        $fourstar = 0;
        if ($this->ratings->count() > 0) {
            foreach ($this->ratings as $rating) {
                $fourstar += (int)$rating->fourstar;
            }
            return $fourstar;
        } else return 0;
    }

    public function getFivestarCountAttribute()
    {
        $fivestar = 0;
        if ($this->ratings->count() > 0) {
            foreach ($this->ratings as $rating) {
                $fivestar += (int)$rating->fivestar;
            }
            return $fivestar;
        } else return 0;
    }

    public function getTotalRatingsAttribute()
    {
        $onestar = 0;
        $twostar = 0;
        $threestar = 0;
        $fourstar = 0;
        $fivestar = 0;
        if ($this->ratings->count() > 0) {
            foreach ($this->ratings as $rating) {
                $onestar += (int)$rating->onestar;
                $twostar += (int)$rating->twostar;
                $threestar += (int)$rating->threestar;
                $fourstar += (int)$rating->fourstar;
                $fivestar += (int)$rating->fivestar;
            }
            return $onestar + $twostar + $threestar + $fourstar + $fivestar;
        } else return 0;
    }

    public function getRatingAttribute()
    {
        $onestar = 0;
        $twostar = 0;
        $threestar = 0;
        $fourstar = 0;
        $fivestar = 0;
        $total_rating = 0.0;
        if ($this->ratings->count() > 0) {
            foreach ($this->ratings as $rating) {
                $onestar += (int)$rating->onestar;
                $twostar += (int)$rating->twostar;
                $threestar += (int)$rating->threestar;
                $fourstar += (int)$rating->fourstar;
                $fivestar += (int)$rating->fivestar;
            }
            $total_rating = (float)$onestar + $twostar + $threestar + $fourstar + $fivestar;
        }

        $weighted_total = (float)$onestar + 2 * $twostar + 3 * $threestar + 4 * $fourstar + 5 * $fivestar;

        if ($weighted_total == 0.0 && $total_rating == 0.0) {
            return 0;
        } else {
            return $weighted_total / $total_rating;
        }
    }

    public function getRouteKeyName()
    {
        return 'instructorcourseid';
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrolments', 'instructorcourseid', 'studentid', 'instructorcourseid', 'infoid')
            ->using(Enrolment::class)
            ->as('enrolment')
            ->withPivot('id', 'enrolmentid', 'enrolled', 'enrolmentfeesexpirydate', 'percentagecompleted', 'connectedtoaudio', 'connectedtovideo', 'connectedtocall', 'connectedtochat')
            ->withTimestamps();
    }

    public function periods()
    {
        return $this->belongsToMany(Timetable::class, 'instructor_course_periods', 'instructorcourseid', 'periodid', 'instructorcourseid', 'timetableid')
            ->using(InstructorCoursePeriod::class)
            ->as('instructorCoursePeriod')
            ->withPivot('id', 'instructorcourseperiodid')
            ->withTimestamps();
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function audios()
    {
        return $this->hasMany(Audio::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function recommendedDocs()
    {
        return $this->hasMany(RecommendedDoc::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institutionid', 'institutionid');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructorid', 'infoid');
    }

    public function instructorUser()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseid', 'courseid');
    }

    public function ratings()
    {
        return $this->hasMany(InstructorCourseRating::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function liveChats()
    {
        return $this->hasMany(LiveChat::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function recordedVideos()
    {
        return $this->hasMany(RecordedVideo::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function recordedStreams()
    {
        return $this->hasMany(RecordedStream::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function recordedVideoStreams()
    {
        return $this->hasMany(RecordedVideoStream::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function recordedAudioStreams()
    {
        return $this->hasMany(RecordedAudioStream::class, 'instructorcourseid', 'instructorcourseid');
    }

    public function drawingCoordinates()
    {
        return $this->hasMany(DrawingCoordinate::class, 'instructorcourseid', 'instructorcourseid');
    }
}

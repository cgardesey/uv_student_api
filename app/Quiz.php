<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = ['id', 'quizid'];
    protected $primaryKey = 'quizid';
    public $incrementing = false;
    protected $keyType = 'string';


    public function getRouteKeyName()
    {
        return 'quizid';
    }

    public function instructorCourse()
    {
        return $this->belongsTo(InstructorCourse::class,'instructorcourseid', 'instructorcourseid');
    }

    public function submittedQuizzes()
    {
        return $this->hasMany(SubmittedQuiz::class, 'quizid', 'quizid');
    }
}

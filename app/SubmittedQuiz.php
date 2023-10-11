<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmittedQuiz extends Model
{
    protected $guarded=['id', 'percentagescore'];
    protected $primaryKey = 'submittedquizid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'submittedquizid';
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid', 'infoid');
    }

    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'quizid','quizid');
    }
}

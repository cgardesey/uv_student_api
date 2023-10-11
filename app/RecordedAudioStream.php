<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecordedAudioStream extends Model
{
    protected $guarded = ['id', 'recordedaudiostreamid'];
    protected $primaryKey = 'recordedaudiostreamid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'recordedaudiostreamid';
    }

    public function instructorCourse()
    {
        return $this->belongsTo(InstructorCourse::class, 'instructorcourseid', 'instructorcourseid');
    }
}

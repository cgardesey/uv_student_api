<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendedDoc extends Model
{
    protected $guarded = ['id', 'recommendeddocid'];
    protected $primaryKey = 'recommendeddocid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'recommendeddocid';
    }

    public function instructorCourse()
    {
        return $this->belongsTo(Course::class, 'instructorcourseid', 'instructorcourseid');
    }
}

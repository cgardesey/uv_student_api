<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrolmentRequest extends Model
{
    protected $guarded = ['id', 'enrolmentrequestid'];
    protected $primaryKey = 'enrolmentrequestid';
    public $incrementing = false;
    protected $keyType = 'string';

    public $table = "enrolment_requests";

    public function getRouteKeyName()
    {
        return 'enrolmentrequestid';
    }
}

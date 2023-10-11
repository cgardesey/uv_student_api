<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    protected $guarded = ['id', 'paymentid'];
    protected $primaryKey = 'paymentid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $appends = ['expired', 'appuserfeeexpired', 'institutionfeeexpired'];

    public function getExpiredAttribute()
    {
        if($this->attributes['expirydate'] == null) {
            return true;
        }
        return !(
            $this->attributes['expirydate'] >= date('Y-m-d') &&
            ($this->attributes['status'] == 'SUCCESS' || $this->attributes['status'] == 'SUCCESSFUL')

        );
    }

    public function getAppuserfeeexpiredAttribute()
    {
        if($this->attributes['appuserfeeexpirydate'] == null) {
            return true;
        }
        return !(
            $this->attributes['appuserfeeexpirydate'] >= date('Y-m-d') &&
            ($this->attributes['status'] == 'SUCCESS' || $this->attributes['status'] == 'SUCCESSFUL')

        );
    }

    public function getInstitutionfeeexpiredAttribute()
    {
        if($this->attributes['institutionfeeexpirydate'] == null) {
            return true;
        }
        return !(
            $this->attributes['institutionfeeexpirydate'] >= date('Y-m-d') &&
            ($this->attributes['status'] == 'SUCCESS' || $this->attributes['status'] == 'SUCCESSFUL')

        );
    }

    public function getRouteKeyName()
    {
        return 'paymentid';
    }

    public function payer()
    {
        return $this->belongsTo(Student::class, 'payerid', 'infoid');
    }

    public function enrolment()
    {
        return $this->belongsTo(Enrolment::class, 'enrolmentid', 'enrolmentid');
    }
}

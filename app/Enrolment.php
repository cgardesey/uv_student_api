<?php

namespace App;

use App\AppUserFee;
use App\InstructorCourse;
use App\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Enrolment extends Pivot
{
    protected $guarded = ['id', 'enrolmentid'];
    protected $primaryKey = 'enrolmentid';
    public $incrementing = false;
    protected $keyType = 'string';

    public $table = "enrolments";

    protected $hidden = [];

    protected $appends = ['enrolmentfeeexpired', 'enrolmentfeeexpirydate', 'appuserfeeexpired', 'appuserfeeexpirydate', 'institutionfeeexpired', 'institutionfeeexpirydate', 'total_ratings', 'onestar_count', 'twostar_count', 'threestar_count', 'fourstar_count', 'fivestar_count', 'rating'];

    public function getOnestarCountAttribute()
    {
        $onestar = 0;
        if ($this->InstructorCourse->ratings->count() > 0) {
            foreach ($this->InstructorCourse->ratings as $rating) {
                $onestar += (int)$rating->onestar;
            }
            return $onestar;
        } else return 0;
    }

    public function getTwostarCountAttribute()
    {
        $twostar = 0;
        if ($this->InstructorCourse->ratings->count() > 0) {
            foreach ($this->InstructorCourse->ratings as $rating) {
                $twostar += (int)$rating->twostar;
            }
            return $twostar;
        } else return 0;
    }

    public function getThreestarCountAttribute()
    {
        $threestar = 0;
        if ($this->InstructorCourse->ratings->count() > 0) {
            foreach ($this->InstructorCourse->ratings as $rating) {
                $threestar += (int)$rating->threestar;
            }
            return $threestar;
        } else return 0;
    }

    public function getFourstarCountAttribute()
    {
        $fourstar = 0;
        if ($this->InstructorCourse->ratings->count() > 0) {
            foreach ($this->InstructorCourse->ratings as $rating) {
                $fourstar += (int)$rating->fourstar;
            }
            return $fourstar;
        } else return 0;
    }

    public function getFivestarCountAttribute()
    {
        $fivestar = 0;
        if ($this->InstructorCourse->ratings->count() > 0) {
            foreach ($this->InstructorCourse->ratings as $rating) {
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
        if ($this->InstructorCourse->ratings->count() > 0) {
            foreach ($this->InstructorCourse->ratings as $rating) {
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
        if ($this->InstructorCourse->ratings->count() > 0) {
            foreach ($this->InstructorCourse->ratings as $rating) {
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

    public function getEnrolmentfeeexpiredAttribute()
    {
        $instructorcourse = InstructorCourse::find($this->attributes['instructorcourseid']);

        switch ($instructorcourse->fee_type_id) {
            case '1':
            case '3':
                if($this->attributes['enrolmentfeesexpirydate'] == null) {
                    return true;
                }
                return !($this->attributes['enrolmentfeesexpirydate'] >= date('Y-m-d'));
            case '2':
                if ($instructorcourse->price == 0 || $instructorcourse->price_day == 0 || $instructorcourse->price_week == 0) {
                    return false;
                }
                $latest_payment = Payment::where('enrolmentid', '=', $this->attributes['enrolmentid'])->latest('created_at')
                    ->whereNotNull('expirydate')
                    ->first();
                return $latest_payment ? $latest_payment->expired : true;
            default:
                'default';
                break;
        }
    }

    public function getEnrolmentfeeexpirydateAttribute()
    {
        $instructorcourse = InstructorCourse::find($this->attributes['instructorcourseid']);

        switch ($instructorcourse->fee_type_id) {
            case '1':
            case '3':
                return ($this->attributes['enrolmentfeesexpirydate']);
            case '2':
                $latest_payment = Payment::where('enrolmentid', '=', $this->attributes['enrolmentid'])->latest('created_at')
                    ->whereNotNull('expirydate')
                    ->first();
                return $latest_payment ? $latest_payment->expirydate : "";
            default:
                'default';
                break;
        }
    }

    public function getAppuserfeeexpiredAttribute()
    {
        $instructorcourse = InstructorCourse::find($this->attributes['instructorcourseid']);
        if ($instructorcourse->fee_type_id == 1) {
            $appuserfee = AppUserFee::first();
            if ($appuserfee->priceperday == 0) {
                return false;
            }
            $latest_appuserfee_payment = Payment::where('payerid', '=', $this->attributes['studentid'])->latest('created_at')
                ->whereNotNull('appuserfeeexpirydate')
                ->first();
            return $latest_appuserfee_payment ? $latest_appuserfee_payment->appuserfeeexpired : true;
        }
        else {
            return false;
        }
    }

    public function getAppuserfeeexpirydateAttribute()
    {
        $instructorcourse = InstructorCourse::find($this->attributes['instructorcourseid']);
        if ($instructorcourse->fee_type_id == 1) {
            $latest_appuserfee_payment = Payment::where('payerid', '=', $this->attributes['studentid'])->latest('created_at')
                ->whereNotNull('appuserfeeexpirydate')
                ->first();
            return $latest_appuserfee_payment ? $latest_appuserfee_payment->appuserfeeexpirydate : "";
        }
        else {
            return "";
        }
    }

    public function getInstitutionfeeexpiredAttribute()
    {
//        return false; // for testing purposes
        $instructorcourse = InstructorCourse::find($this->attributes['instructorcourseid']);
        if ($instructorcourse->institutionid == null || $instructorcourse->institutionid == "") {
            return true;
        }

        $institution = Institution::find($instructorcourse->institutionid);
        if ($institution->internalinstitution == 0) {
            return true;
        }
        $latest_institution_payment = Payment::where('payerid', '=', $this->attributes['studentid'])
            ->where('institutionid', '=', $instructorcourse->institutionid)
            ->latest('created_at')
            ->first();
        return $latest_institution_payment ? $latest_institution_payment->institutionfeeexpired : true;
    }

    public function getInstitutionfeeexpirydateAttribute()
    {
        $instructorcourse = InstructorCourse::find($this->attributes['instructorcourseid']);
        $institution = Institution::find($instructorcourse->institutionid);
        if ($institution && $institution->internalinstitution == 0) {
            return "";
        }
        $latest_institution_payment = Payment::where('payerid', '=', $this->attributes['studentid'])
            ->where('institutionid', '=', $instructorcourse->institutionid)
            ->latest('created_at')
            ->first();
        return $latest_institution_payment ? $latest_institution_payment->institutionfeeexpirydate : "";
    }

    public function getRouteKeyName()
    {
        return 'enrolmentid';
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'enrolmentid', 'enrolmentid');
    }

    public function instructorCourse()
    {
        return $this->belongsTo(instructorCourse::class, 'instructorcourseid', 'instructorcourseid');
    }
}

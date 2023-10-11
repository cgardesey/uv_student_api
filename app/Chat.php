<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = ['id'];
    protected $primaryKey = 'chatid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'chatid';
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'senderid', 'userid');
    }

    public function recepient()
    {
        return $this->belongsTo(User::class, 'recepientid', 'userid');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseid', 'courseid');
    }
}

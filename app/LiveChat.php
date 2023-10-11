<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveChat extends Model
{
    protected $guarded = ['id'];
    protected $primaryKey = 'livechatid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'livechatid';
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

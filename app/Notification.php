<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = ['id', 'notificationid'];
    protected $primaryKey = 'notificationid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'notificationid';
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'senderid', 'ownerid');
    }

}

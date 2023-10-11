<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'email', 'password', 'role',
    ];*/

    protected $guarded = ['id', 'userid'];
    protected $primaryKey = 'userid';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'active', 'otp', 'apphash', 'osversion', 'sdkversion', 'device', 'devicemodel', 'deviceproduct', 'manufacturer', 'androidid', 'versionrelease', 'deviceheight', 'devicewidth', 'email_verified_at', 'password', 'api_token', 'email_verified', 'info'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info()
    {
        return $this->morphTo(null, 'role', 'userid', 'infoid');
    }

    public function sentChatMessages()
    {
        return $this->hasMany(Chat::class, 'senderid', 'userid');
    }

    public function receivedChatMessages()
    {
        return $this->hasMany(Chat::class, 'recepientid', 'userid');
    }

    public function sentNotification()
    {
        return $this->hasMany(Notification::class,'senderid', 'userid');
    }
}

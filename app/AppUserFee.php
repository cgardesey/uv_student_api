<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUserFee extends Model
{
    protected $guarded = ['id', 'appuserfeeid'];
    protected $primaryKey = 'appuserfeeid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = [];

    public function getRouteKeyName()
    {
        return 'appuserfeeid';
    }
}

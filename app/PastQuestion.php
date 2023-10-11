<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PastQuestion extends Model
{
    protected $guarded=['id'];
    protected $primaryKey = 'questionid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'questionid';
    }
}

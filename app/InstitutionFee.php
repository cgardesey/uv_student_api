<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstitutionFee extends Model
{
    protected $guarded = ['id', 'institutionfeeid'];
    protected $primaryKey = 'institutionfeeid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'institutionfeeid';
    }
}

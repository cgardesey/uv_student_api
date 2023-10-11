<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $guarded = ['id', 'faqid'];
    protected $primaryKey = 'faqid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'faqid';
    }
}

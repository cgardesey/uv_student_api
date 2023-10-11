<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionChangeRequest extends Model
{
    protected $guarded = ['id', 'subscriptionchangerequestid'];
    protected $primaryKey = 'subscriptionchangerequestid';
    public $incrementing = false;
    protected $keyType = 'string';

    public $table = "subscription_change_requests";

    public function getRouteKeyName()
    {
        return 'subscriptionchangerequestid';
    }
}

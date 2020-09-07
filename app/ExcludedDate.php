<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcludedDate extends Model
{
    public function cityDeliveryTime()
    {
        return $this->belongsTo('App\CityDeliveryTime', 'city_delivery_time_id');
    }
}

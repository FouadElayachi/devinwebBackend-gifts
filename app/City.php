<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function deliveries()
    {
        return $this->belongsToMany('App\DeliveryTime', 'city_delivery_times')->withTimestamps();
    }
}

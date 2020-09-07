<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    public function cities()
    {
        return $this->belongsToMany('App\City', 'city_delivery_times');
    }
}

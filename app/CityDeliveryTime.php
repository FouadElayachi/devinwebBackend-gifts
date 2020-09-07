<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityDeliveryTime extends Model
{
    public function excludedDates()
    {
        return $this->hasMany('App\ExcludedDate');
    }
}

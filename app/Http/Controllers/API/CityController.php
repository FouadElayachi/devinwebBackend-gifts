<?php

namespace App\Http\Controllers;

use App\City;
use App\CityDeliveryTime;
use App\DeliveryTime;
use App\ExcludedDate;
use App\Dtos\DateDto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return City::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = new City;
        $city->name = $request->name;
        $city->country_id = 1;
        $city->save();
        return response()->json($city, 201);
    }

    public function attachCityToDeliveryTimes(Request $request, $city_id)
    {
        $city = City::find($city_id);

        $deliveryIds = $request->deliveryIds;
        foreach($deliveryIds as $deliveryId) {
            $city->deliveries()->attach($deliveryId);
        }
    }

    public function ExcludDeliveryTimeOnDateFromCity(Request $request, $city_id)
    {
        $city = City::find($city_id);
        
        if(isset($request->deliveryId) && !empty($request->deliveryId))
            $deliveryId = $request->deliveryId;

        
        $date = $request->date;

        if(isset($request->deliveryId) && !empty($request->deliveryId)) {
            $cityDeliveryTime = CityDeliveryTime::where('city_id', '=', $city_id)->where('delivery_time_id', '=', $deliveryId)->first();

            $excludedDate = new ExcludedDate;
            $excludedDate->excluded_date = $date;
            $excludedDate->city_delivery_time_id = $cityDeliveryTime->id;
            $excludedDate->save();
        }

        else {
            $cityDeliveryTimes = CityDeliveryTime::where('city_id', '=', $city_id)->get();
            foreach($cityDeliveryTimes as $cityDeliveryTime) {
                $excludedDate = new ExcludedDate;
                $excludedDate->excluded_date = $date;
                $excludedDate->city_delivery_time_id = $cityDeliveryTime->id;
                $excludedDate->save();
            }
        }

        return response()->json($excludedDate, 201);
    }

    public function displayAvailableDeliveryTimesOnrangDate($city_id, $number_of_days)
    {
        $city = City::find($city_id);
        $cityDeliveryTimes = CityDeliveryTime::where('city_id', $city_id)->get();
        $nowDate = Carbon::now();
        $dates = [];

        $delivery_times = [];
        $delivery_times = $city->deliveries()->get();
                
        for ($i=0; $i < $number_of_days; $i++) { 
            $dateIncrement = $nowDate->addDays(1);
            $dateDto = new DateDto();
            $dateDto->day_name = $dateIncrement->format('l');
            $dateDto->date = $dateIncrement->format('Y-m-d');
            $deliveryTimes = DB::table('delivery_times')
            ->join('city_delivery_times', 'delivery_times.id', '=', 'city_delivery_times.delivery_time_id')
            ->join('excluded_dates', 'city_delivery_times.id', '=', 'excluded_dates.city_delivery_time_id')
            ->where('city_delivery_times.city_id', $city_id)
            ->where('excluded_dates.excluded_date', '!=', $dateDto->date)
            ->select('delivery_times.*')
            ->get();
            $dateDto->delivery_times = $deliveryTimes;
            $dates[$i] = $dateDto;  
        }

        return response()->json(
                ['dates' => $dates]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}

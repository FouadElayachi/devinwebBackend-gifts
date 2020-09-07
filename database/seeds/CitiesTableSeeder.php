<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = new DateTime();
        App\City::create([
            'name' => 'Rabat',
            'longitude' => '-6.8498129',
            'latitude' => '33.9715904',
            'country_id' => '1',
            'created_at' => $dt->format('Y-m-d H:i:s')
        ]);
        App\City::create([
            'name' => 'Casablanca',
            'longitude' => '-7.5898434',
            'latitude' => '33.5731104',
            'country_id' => '1',
            'created_at' => $dt->format('Y-m-d H:i:s')
        ]);
        App\City::create([
            'name' => 'Tanger',
            'longitude' => '-5.833954',
            'latitude' => '35.759465',
            'country_id' => '1',
            'created_at' => $dt->format('Y-m-d H:i:s')
        ]);
    }
}

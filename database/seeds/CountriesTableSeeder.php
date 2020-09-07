<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = new DateTime();
        App\Country::create([
            'name' => 'Maroc',
            'created_at' => $dt->format('Y-m-d H:i:s')
        ]);
    }
}

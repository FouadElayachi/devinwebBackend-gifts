<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\City;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = new DateTime();
        $cityMohammed = City::where('name', '=', 'Rabat')->first();
        $cityHassan = City::where('name', '=', 'Casablanca')->first();
        $cityNada = City::where('name', '=', 'Tanger')->first();
        App\User::create([
            'username' => 'Mohamed',
            'email' => Str::random(10).'@gmail.com',
            'civility' => 'M.',
            'user_type' => 'partner',
            'password' => Hash::make('password'),
            'city_id' => $cityMohammed->id,
            'created_at' => $dt->format('Y-m-d H:i:s')
        ]);
        App\User::create([
            'username' => 'Hassan',
            'email' => Str::random(10).'@gmail.com',
            'civility' => 'M.',
            'user_type' => 'partner',
            'password' => Hash::make('password'),
            'city_id' => $cityHassan->id,
            'created_at' => $dt->format('Y-m-d H:i:s')
        ]);
        App\User::create([
            'username' => 'Nada',
            'email' => Str::random(10).'@gmail.com',
            'civility' => 'Mme',
            'user_type' => 'partner',
            'password' => Hash::make('password'),
            'city_id' => $cityNada->id,
            'created_at' => $dt->format('Y-m-d H:i:s')
        ]);
    }
}

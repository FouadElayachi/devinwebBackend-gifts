<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityDeliveryTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_delivery_times', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::table('city_delivery_times', function (Blueprint $table) {
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->foreignId('delivery_time_id')->constrained('delivery_times')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_delivery_times');
    }
}

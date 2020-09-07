<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcludedDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excluded_dates', function (Blueprint $table) {
            $table->id();
            $table->date('excluded_date');
            $table->timestamps();
        });

        Schema::table('excluded_dates', function (Blueprint $table) {
            $table->foreignId('city_delivery_time_id')->constrained('city_delivery_times')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excluded_dates');
    }
}

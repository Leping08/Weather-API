<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePressuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pressures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('millibars', 10, 6);
            $table->dateTime('measurement_time');
            $table->timestamps();
        });

        Schema::table('humidities', function (Blueprint $table){
            $table->dateTime('measurement_time')->after('percentage');
        });

        Schema::table('temperatures', function (Blueprint $table){
            $table->dateTime('measurement_time')->after('degrees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pressures');

        Schema::table('humidities', function (Blueprint $table) {
            $table->dropColumn('measurement_time');
        });

        Schema::table('temperatures', function (Blueprint $table) {
            $table->dropColumn('measurement_time');
        });
    }
}

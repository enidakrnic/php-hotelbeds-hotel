<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelbedsHotelFacilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = config('hotelbeds-hotel.table_names.facilities');

        Schema::connection('hotelbeds-hotel')->create($table, function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('code');
            $table->bigInteger('facility_group_code');
            $table->bigInteger('facility_typology_code');
            $table->timestamps();

            $table->index('code');
            $table->index('facility_group_code');
            $table->index('facility_typology_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = config('hotelbeds-hotel.table_names.facilities');

        Schema::connection('hotelbeds-hotel')->dropIfExists($table);
    }
}
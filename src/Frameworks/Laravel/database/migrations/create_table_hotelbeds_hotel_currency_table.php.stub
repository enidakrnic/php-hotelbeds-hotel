<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelbedsHotelCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = config('hotelbeds-hotel.table_names.currencies');

        Schema::connection('hotelbeds-hotel')->create($table, function (Blueprint $table) {
            $table->id('id');
            $table->string('code')->unique();
            $table->string('currency_type');
            $table->timestamps();

            $table->index('currency_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = config('hotelbeds-hotel.table_names.currencies');

        Schema::connection('hotelbeds-hotel')->dropIfExists($table);
    }
}
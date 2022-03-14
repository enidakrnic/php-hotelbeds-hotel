<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelbedsHotelBoardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = config('hotelbeds-hotel.table_names.boards');

        Schema::connection('hotelbeds-hotel')->create($table, function (Blueprint $table) {
            $table->id('id');
            $table->string('code')->unique();
            $table->string('multi_lingual_code')->nullable();
            $table->timestamps();

            $table->index('multi_lingual_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = config('hotelbeds-hotel.table_names.boards');

        Schema::connection('hotelbeds-hotel')->dropIfExists($table);
    }
}
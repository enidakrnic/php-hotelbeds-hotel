<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelbedsHotelNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = config('hotelbeds-hotel.table_names.names');

        Schema::connection('hotelbeds-hotel')->create($table, function (Blueprint $table) {
            $table->id();
            $table->string('language_code');
            $table->text('content');
            $table->string('nameable_id');
            $table->string('nameable_type');
            $table->timestamps();

            $table->index('language_code');
            $table->index('nameable_id');
            $table->index('nameable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = config('hotelbeds-hotel.table_names.names');

        Schema::connection('hotelbeds-hotel')->dropIfExists($table);
    }
}
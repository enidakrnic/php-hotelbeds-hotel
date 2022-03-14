<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelbedsHotelLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = config('hotelbeds-hotel.table_names.languages');

        Schema::connection('hotelbeds-hotel')->create($table, function (Blueprint $table) {
            $table->id('id');
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->timestamps();

            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = config('hotelbeds-hotel.table_names.languages');

        Schema::connection('hotelbeds-hotel')->dropIfExists($table);
    }
}
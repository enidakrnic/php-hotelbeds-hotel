<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelbedsHotelCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = config('hotelbeds-hotel.table_names.categories');

        Schema::connection('hotelbeds-hotel')->create($table, function (Blueprint $table) {
            $table->id('id');
            $table->string('accommodation_type');
            $table->string('code')->unique();
            $table->string('group')->nullable();
            $table->bigInteger('simple_code');
            $table->timestamps();

            $table->index('accommodation_type');
            $table->index('group');
            $table->index('simple_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = config('hotelbeds-hotel.table_names.categories');

        Schema::connection('hotelbeds-hotel')->dropIfExists($table);
    }
}
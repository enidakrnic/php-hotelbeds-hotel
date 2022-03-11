<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelbedsHotelDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = config('hotelbeds-hotel.table_names.descriptions');

        Schema::connection('hotelbeds-hotel')->create($table, function (Blueprint $table) {
            $table->id();
            $table->string('language_code');
            $table->string('content');
            $table->string('descriptionable_id');
            $table->string('descriptionable_type');
            $table->timestamps();

            $table->index('language_code');
            $table->index('content');
            $table->index('descriptionable_id');
            $table->index('descriptionable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = config('hotelbeds-hotel.table_names.descriptions');

        Schema::connection('hotelbeds-hotel')->dropIfExists($table);
    }
}
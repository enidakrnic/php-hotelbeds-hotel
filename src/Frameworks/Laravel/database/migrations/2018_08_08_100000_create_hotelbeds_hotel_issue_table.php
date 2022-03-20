<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelbedsHotelIssueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = config('hotelbeds-hotel.table_names.issues');

        Schema::connection('hotelbeds-hotel')->create($table, function (Blueprint $table) {
            $table->id('id');
            $table->string('code');
            $table->string('type');
            $table->boolean('alternative');
            $table->timestamps();

            $table->index('code');
            $table->index('type');
            $table->index('alternative');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = config('hotelbeds-hotel.table_names.issues');

        Schema::connection('hotelbeds-hotel')->dropIfExists($table);
    }
}
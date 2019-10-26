<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flightcases', function (Blueprint $table) {
            $table->bigIncrements('casenumber');
            $table->date('departuredate');
            $table->string('flightnumber');
            $table->string('bookingnumber');
            $table->string('issue');

        });
        DB::statement("ALTER TABLE flightcases ADD CONSTRAINT issue_type CHECK (issue='Cancellation' or issue='Delay' or issue='Overbooking');");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flightcases');
    }
}

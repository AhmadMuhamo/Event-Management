<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSirttsRegistrationEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('sirtts_registration_events', function (Blueprint $table) {
          $table->increments('id')->unsigned();
          $table->string('event_id');
          $table->string('course');
          $table->string('location');
          $table->float('fees');
          $table->string('currency');
          $table->timestamps();
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropDownIfExists('sirtts_registration_events');
    }
}

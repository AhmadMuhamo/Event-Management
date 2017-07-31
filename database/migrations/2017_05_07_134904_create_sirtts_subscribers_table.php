<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSirttsSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sirtts_subscribers' , function (Blueprint $table)  {
            $table->increments('id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('sirtts_events');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('sirtts_users');
            $table->integer('dependent_id')->unsigned()->nullable();
            $table->foreign('dependent_id')->references('id')->on('sirtts_dependents');
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
        Schema::dropIfExists('sirtts_subscribers');
    }
}

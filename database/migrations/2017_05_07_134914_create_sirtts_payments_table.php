<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSirttsPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sirtts_payments', function (Blueprint $table)  {
           $table->increments('id')->unsigned();
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('sirtts_users');
           $table->integer('event_id')->unsigned();
           $table->foreign('event_id')->references('id')->on('sirtts_events');
           $table->string('payer_id')->nullable();
           $table->string('payment_id')->nullable();
           $table->string('payment_method')->nullable();
           $table->string('status');
           $table->string('amount')->nullable();
           $table->string('refund_url')->nullable();
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
        Schema::dropdownIfExists('sirtts_payments');
    }
}

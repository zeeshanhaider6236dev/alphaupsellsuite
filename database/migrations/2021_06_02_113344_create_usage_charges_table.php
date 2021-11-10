<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsageChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('charge_id')->unsigned();
            $table->string('status')->dafault('ACTIVE');
            $table->string('usage_charge_id');
            $table->string('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->timestamp('billing_on')->nullable();
            $table->decimal('balance_used', 8, 2);
            $table->decimal('balance_remaining', 8, 2);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('charge_id')->references('id')->on('charges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usage_charges');
    }
}

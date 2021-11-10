<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpsellDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upsell_discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upsell_id');
            $table->foreign('upsell_id')->references('id')->on('upsells')->onDelete('cascade');
            // $table->string('discount_type');
            $table->string('price_rule_id');
            $table->string('discount_code');
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
        Schema::dropIfExists('upsell_discounts');
    }
}

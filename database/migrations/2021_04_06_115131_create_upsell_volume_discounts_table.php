<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpsellVolumeDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upsell_volume_discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upsell_id');
            $table->foreign('upsell_id')->references('id')->on('upsells')->onDelete('cascade');
            $table->bigInteger('quantity');
            $table->bigInteger('discount');
            $table->string('discount_type');
            $table->string('price_rule_id');
            $table->string('discount_code');
            $table->boolean('best_deal')->default(0)->nullable();
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
        Schema::dropIfExists('upsell_volumes_discounts');
    }
}

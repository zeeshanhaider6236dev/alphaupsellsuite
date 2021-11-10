<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpsellProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upsell_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upsell_id')->constrained('upsells')->onDelete('cascade');
            $table->enum('type',['targeted','appearOn','downsell'])->default('targeted');
            $table->string('shopify_product_id');
            $table->text('shopify_product_title');
            $table->text('shopify_product_image');
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
        Schema::dropIfExists('upsell_products');
    }
}

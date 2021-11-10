<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpsellCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upsell_collections', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['targeted','appearOn'])->default('targeted');
            $table->string('shopify_collection_id');
            $table->text('shopify_collection_title');
            $table->text('shopify_collection_image');
            $table->foreignId('upsell_id')->constrained('upsells')->onDelete('cascade');
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
        Schema::dropIfExists('upsell_collections');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpsellStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upsell_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upsell_id')->constrained('upsells')->onDelete('cascade');
            $table->enum('type',['views','add_to_cart','transactions','sells']);
            $table->bigInteger('value')->unsigned();
            $table->timestamp('upsell_created_at');
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
        Schema::dropIfExists('upsell_stats');
    }
}

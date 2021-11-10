<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpsellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upsells', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upsell_type_id')->constrained('upsell_types')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->boolean('auto')->default(false);
            $table->json('setting');
            $table->bigInteger('views')->default(0);
            $table->bigInteger('add_to_carts')->default(0);
            $table->bigInteger('transactions')->default(0);
            $table->bigInteger('sells')->default(0);
            $table->integer('priority')->default(1);
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
        Schema::dropIfExists('upsells');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpsellTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upsell_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upsell_type_id')->constrained('upsell_types')->onDelete('cascade');
            $table->string('name');
            $table->string('template_path');
            $table->json('setting');
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
        Schema::dropIfExists('upsell_templates');
    }
}

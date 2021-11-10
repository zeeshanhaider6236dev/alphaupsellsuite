<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('setup')->default(0);
            $table->boolean('enable')->default(0);
            $table->boolean('scripttag')->default(0);
            $table->string('language');
            $table->string('currency');
            $table->string('themeId');
            $table->string('script_tag_id')->nullable();
            $table->string('domain');
            $table->text('store_name')->nullable();
            $table->text('store_email')->nullable();
            $table->string('store_phone')->nullable();
            $table->string('country_name')->nullable();
            $table->string('plan_display_name')->nullable();
            $table->timestamp('trial_ends')->nullable();
            $table->timestamp('last_updated')->nullable();
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
        Schema::dropIfExists('settings');
    }
}

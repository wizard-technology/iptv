<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_apps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ac_app');
            $table->foreign('ac_app')->references('id')->on('applications'); 
            $table->unsignedBigInteger('ac_channel');
            $table->foreign('ac_channel')->references('id')->on('channels'); 
            $table->unsignedBigInteger('ac_admin');
            $table->foreign('ac_admin')->references('id')->on('users'); 
            $table->timestamps();
            $table->unique(['ac_app', 'ac_channel'],'unique_5');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_apps');
    }
}

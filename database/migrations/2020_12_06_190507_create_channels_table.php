<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('ch_title');
            $table->string('ch_subtitle')->nullable();
            $table->string('ch_image')->nullable();
            $table->text('ch_link');
            $table->tinyInteger('ch_star');
            $table->boolean('ch_state');
            $table->unsignedBigInteger('ch_category');
            $table->foreign('ch_category')->references('id')->on('categores'); 
            $table->unsignedBigInteger('ch_admin');
            $table->foreign('ch_admin')->references('id')->on('users'); 
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
        Schema::dropIfExists('channels');
    }
}

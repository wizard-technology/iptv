<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->string('app_fcm')->nullable();
            $table->string('app_access');
            $table->string('app_secret');
            $table->enum('app_type',['IOS','Android','Desktop','Website']);
            $table->boolean('app_state')->default(0);
            $table->unsignedBigInteger('app_admin');
            $table->foreign('app_admin')->references('id')->on('users'); 
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
        Schema::dropIfExists('applications');
    }
}

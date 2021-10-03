<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobotVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robot_verifications', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('url_id');
            $table->string('status_code',3);            
            $table->timestamps();

            $table->foreign('url_id')->references('id')->on('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('robot_verifications');
    }
}

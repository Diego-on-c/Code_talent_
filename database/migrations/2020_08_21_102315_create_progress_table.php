<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{

    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->integer('percentage');
            $table->foreignId('course_id');
            $table->date('last_connection');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('progress');
    }
}

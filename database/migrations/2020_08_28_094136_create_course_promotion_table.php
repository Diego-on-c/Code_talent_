<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePromotionTable extends Migration
{

    public function up()
    {
        Schema::create('course_promotion', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->nullable();
            $table->integer('promotion_id')->nullable();            ;
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('course_promotion');
    }
}

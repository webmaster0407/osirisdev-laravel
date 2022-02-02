<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetencesTable extends Migration
{
    public function up()
    {
        Schema::create('competences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key')->unique();
            $table->string('name');
            $table->string('abbreviation')->unique();
            $table->string('type');
            $table->string('color')->nullable();;
            $table->boolean('expirable')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

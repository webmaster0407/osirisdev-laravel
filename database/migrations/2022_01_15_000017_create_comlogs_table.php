<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComlogsTable extends Migration
{
    public function up()
    {
        Schema::create('comlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('subject')->nullable();
            $table->string('message')->nullable();
            $table->string('type')->nullable();
            $table->string('extrainfo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

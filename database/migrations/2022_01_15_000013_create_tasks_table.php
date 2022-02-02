<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description')->nullable();
            $table->boolean('completed')->default(0)->nullable();
            $table->string('relationtype')->nullable();
            $table->integer('relationid')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

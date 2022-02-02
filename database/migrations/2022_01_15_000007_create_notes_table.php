<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('note');
            $table->string('relationtype');
            $table->integer('relationid');
            $table->string('visability')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

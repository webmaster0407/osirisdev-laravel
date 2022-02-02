<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventregistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('eventregistrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('regnotes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

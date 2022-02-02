<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrevregistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('prevregistrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('regnotes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

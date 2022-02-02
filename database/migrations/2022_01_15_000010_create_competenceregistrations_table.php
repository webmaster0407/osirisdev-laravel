<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceregistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('competenceregistrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->string('regnotes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

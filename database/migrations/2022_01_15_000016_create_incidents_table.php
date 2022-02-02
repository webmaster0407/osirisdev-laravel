<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->longText('description')->nullable();
            $table->longText('internalinfo')->nullable();
            $table->date('date');
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

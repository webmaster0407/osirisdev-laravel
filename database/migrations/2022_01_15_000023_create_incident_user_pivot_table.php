<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('incident_user', function (Blueprint $table) {
            $table->unsignedBigInteger('incident_id');
            $table->foreign('incident_id', 'incident_id_fk_5795968')->references('id')->on('incidents')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_5795968')->references('id')->on('users')->onDelete('cascade');
        });
    }
}

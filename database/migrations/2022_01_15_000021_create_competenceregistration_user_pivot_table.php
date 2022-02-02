<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceregistrationUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('competenceregistration_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_4435319')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('competenceregistration_id');
            $table->foreign('competenceregistration_id', 'competenceregistration_id_fk_4435319')->references('id')->on('competenceregistrations')->onDelete('cascade');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCompetenceregistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('competenceregistrations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_4435299')->references('id')->on('users');
            $table->unsignedBigInteger('competence_id')->nullable();
            $table->foreign('competence_id', 'competence_fk_4435300')->references('id')->on('competences');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPrevregistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('prevregistrations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5541401')->references('id')->on('users');
            $table->unsignedBigInteger('prev_id')->nullable();
            $table->foreign('prev_id', 'prev_fk_5541402')->references('id')->on('prevs');
        });
    }
}

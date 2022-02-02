<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventregistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('eventregistrations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5795842')->references('id')->on('users');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id', 'event_fk_5795843')->references('id')->on('events');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('createduser_id')->nullable();
            $table->foreign('createduser_id', 'createduser_fk_5795775')->references('id')->on('users');
            $table->unsignedBigInteger('assigneduser_id')->nullable();
            $table->foreign('assigneduser_id', 'assigneduser_fk_5795776')->references('id')->on('users');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPrevsTable extends Migration
{
    public function up()
    {
        Schema::table('prevs', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_4361712')->references('id')->on('locations');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4432942')->references('id')->on('users');
            $table->unsignedBigInteger('prevresponsible_id')->nullable();
            $table->foreign('prevresponsible_id', 'prevresponsible_fk_5540650')->references('id')->on('users');
        });
    }
}

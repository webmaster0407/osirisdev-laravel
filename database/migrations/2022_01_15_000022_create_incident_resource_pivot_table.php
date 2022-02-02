<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentResourcePivotTable extends Migration
{
    public function up()
    {
        Schema::create('incident_resource', function (Blueprint $table) {
            $table->unsignedBigInteger('incident_id');
            $table->foreign('incident_id', 'incident_id_fk_5795967')->references('id')->on('incidents')->onDelete('cascade');
            $table->unsignedBigInteger('resource_id');
            $table->foreign('resource_id', 'resource_id_fk_5795967')->references('id')->on('resources')->onDelete('cascade');
        });
    }
}

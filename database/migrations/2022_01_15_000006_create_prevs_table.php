<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrevsTable extends Migration
{
    public function up()
    {
        Schema::create('prevs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('prevtype');
            $table->longText('description')->nullable();
            $table->longText('internalinfo')->nullable();
            $table->date('date');
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->time('rvtime')->nullable();
            $table->boolean('papyrus')->default(0)->nullable();
            $table->boolean('prima')->default(0)->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->integer('cares')->nullable();
            $table->integer('ambulancetransports')->nullable();
            $table->longText('report')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

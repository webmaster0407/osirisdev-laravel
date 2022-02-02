<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->boolean('two_factor')->default(0)->nullable();
            $table->string('emailprivate')->nullable();
            $table->string('two_factor_code')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('city')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('rkid')->nullable()->unique();
            $table->integer('dghid')->nullable();
            $table->string('phone')->nullable();
            $table->integer('pagerid')->nullable();
            $table->datetime('two_factor_expires_at')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

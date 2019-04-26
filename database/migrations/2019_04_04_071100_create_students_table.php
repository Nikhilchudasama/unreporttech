<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->uuid('uuid');
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('mobile_no');
            $table->text('finger')->nullable();
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}

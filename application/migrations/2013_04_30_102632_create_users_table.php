<?php

class Create_Users_Table
{

    public function up()
    {
	Schema::create('users', function($table)
		{
		    $table->increments('id');
		    $table->string('display_name', 100)->nullable();
		    $table->string('first_name', 50);
		    $table->string('last_name', 50);
		    $table->string('email', 100)->unique();
		    $table->string('password', 64);
		    $table->boolean('gender')->default(false);
		    $table->string('new_pass_token', 64)->nullable();
		    $table->string('mobile_phone', 20)->nullable();
		    $table->string('home_phone', 20)->nullable();
		    $table->string('office_phone', 26)->nullable();
		    $table->string('address')->nullable();
		    $table->timestamps();
		});
    }

    public function down()
    {
	Schema::drop('users');
    }

}
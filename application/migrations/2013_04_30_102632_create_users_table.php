<?php

class Create_Users_Table {    

    public function up()
    {
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('display_name', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password', 64);
            $table->string('new_pass_token', 64)->nullable();
            $table->string('mobile_phone', 20)->nullable();
            $table->string('home_phone', 20)->nullable();
            $table->string('office_phone', 26)->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            
    });
    
    User::create(array(
	'email' => 'letrunghieu.cse09@gmail.com',
	'password' => Hash::make('admin'),
    ));

    }    

    public function down()
    {
        Schema::drop('users');
    }

}
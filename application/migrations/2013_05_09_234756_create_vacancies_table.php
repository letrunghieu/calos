<?php

class Create_Vacancies_Table
{

    public function up()
    {
	Schema::create('vacancies', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 100);
		    $table->string('description', 1024)->nullable();
		    $table->integer('supervisor_id')->nullable();
		    $table->boolean('is_current_valid')->default(true);
		    $table->integer('capacity')->default(0);
		    $table->integer('order')->default(0);
		    $table->integer('organizationunit_id');
		    $table->timestamps();
		});

	Schema::create('user_vacancy', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->integer('vacancy_id');
		    $table->boolean('is_valid')->default(true);
		    $table->timestamps();
		});
    }

    public function down()
    {
	Schema::drop('user_vacancy');
	Schema::drop('vacancies');
    }

}
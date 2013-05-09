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
		    $table->timestamps();
		});

	$vacancy = Vacancy::create(array(
		    'name' => 'Chairman',
		    'capacity' => 1,
	));

	Vacancy::create(array(
	    'name' => 'Vice Chairman',
	    'capacity' => 2,
	    'order' => 1,
	));

	User::find(1)->vacancies()->attach($vacancy->id);
	$org = OrganizationUnit::find(1);
	$org->leader_vacancy_id = $vacancy->id;
	$org->save();
    }

    public function down()
    {
	Schema::drop('user_vacancy');
	Schema::drop('vacancies');
    }

}
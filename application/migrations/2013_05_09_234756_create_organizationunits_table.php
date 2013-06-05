<?php

class Create_Organizationunits_Table
{

    public function up()
    {
	Schema::create('organizationunits', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 100);
		    $table->text('description')->nullable();
		    $table->integer('leader_vacancy_id')->nullable();
		    $table->integer('parent_id')->nullable();
		    $table->boolean('is_valid')->default(true);
		    $table->timestamps();
		});
    }

    public function down()
    {
	Schema::drop('organizationunits');
    }

}
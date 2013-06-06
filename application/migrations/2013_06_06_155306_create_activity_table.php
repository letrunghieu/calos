<?php

class Create_Activity_Table
{

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
	Schema::create('activities', function($table)
		{
		    $table->increments('id');
		    $table->string('title');
		    $table->text('description');
		    $table->integer('creator_id');
		    $table->string('creator_comment', 2048)->nullable();
		    $table->integer('organizationunit_id');
		    $table->integer('assignee_id')->nullable();
		    $table->timestamp('assigning_time')->nullable();
		    $table->timestamp('deadline');
		    $table->timestamp('completed_time')->nullable();
		    $table->integer('progress')->default(0);
		    $table->integer('parent_id')->nullable();
		    $table->boolean('is_valid')->default(true);
		    $table->timestamps();
		});
    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
	Schema::drop('activities');
    }

}
<?php

class Create_Announcement_Table
{

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
	Schema::create('announcements', function($table)
		{
		    $table->increments('id');
		    $table->string('title');
		    $table->text('content');
		    $table->integer('creator_id');
		    $table->integer('organizationunit_id');
		    $table->boolean('is_valid');
		    $table->timestamps();
		});

	Schema::create('user_announcement', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->integer('announcement_id');
		    $table->boolean('is_read')->default(false);
		    $table->string('reply', 1024)->nullable();
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
	Schema::drop('announcements');
	Schema::drop('user_announcement');
    }

}
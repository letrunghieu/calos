<?php

class Create_Options_Table {    

    public function up()
    {
        Schema::create('options', function($table) {
            $table->increments('id');
            $table->string('option_key')->unique();
            $table->text('value');
            
    });

    }    

    public function down()
    {
        Schema::drop('options');
    }

}
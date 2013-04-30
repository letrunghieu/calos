<?php

class Create_Metavalues_Table {    

    public function up()
    {
        Schema::create('metavalues', function($table) {
            $table->increments('id');
            $table->integer('object_id');
            $table->integer('meta_id');
            $table->text('meta_value');
            
    });

    }    

    public function down()
    {
        Schema::drop('metavalues');
    }

}
<?php

class Create_Metas_Table {    

    public function up()
    {
        Schema::create('metas', function($table) {
            $table->increments('id');
            $table->string('meta_key')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type', 100);
            $table->string('object', 40);
            $table->text('domain')->nullable();
            $table->timestamps();
            
    });

    }    

    public function down()
    {
        Schema::drop('metas');
    }

}
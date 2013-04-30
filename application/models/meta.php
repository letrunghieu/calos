<?php

class Meta extends Basemodel
{
    public static $timestamps = true;

    public static $rules = array(
        'key' => 'required',
        'title' => 'required',
        'type' => 'required',
        
    );


}
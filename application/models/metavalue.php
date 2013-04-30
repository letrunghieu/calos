<?php

class MetaValue extends Basemodel
{
    public static $timestamps = false;

    public static $rules = array(
        'object_id' => 'required',
        'meta_id' => 'required',
        'meta_value' => 'required',
        
    );


}
<?php

class User extends Basemodel
{
    public static $timestamps = true;

    public static $rules = array(
        'username' => 'required',
        'email' => 'required|mail',
        'password' => 'required',
        
    );


}
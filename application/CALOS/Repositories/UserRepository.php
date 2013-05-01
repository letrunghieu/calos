<?php

namespace CALOS\Repositories;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserRepository
{

    public static function find_by_email($email)
    {
	$user = \User::where('email', '=', $email)->first();
	if ($user)
	{
	    $user_entity = static::convert_from_orm($user);
	    return $user_entity;
	} else
	{
	    return null;
	}
    }

    public static function save(\CALOS\Entities\UserEntity $user_entity)
    {
	$user = \User::find($user_entity->get_id());
	if ($user)
	{
	    $user->display_name = $user_entity->display_name;
	    $user->email = $user_entity->email;
	    $user->password = $user_entity->password;
	    $user->new_pass_token = $user_entity->new_pass_token;
	    $user->mobile_phone = $user_entity->mobile_phone;
	    $user->home_phone = $user_entity->home_phone;
	    $user->office_phone = $user_entity->office_phone;
	    $user->address = $user_entity->address;

	    $user->save();
	    return true;
	}
	return false;
    }

    private static function convert_from_orm($user)
    {
	$user_entity = new \CALOS\Entities\UserEntity($user->id);
	
	$user_entity->display_name = $user->display_name;
	$user_entity->email = $user->email;
	$user_entity->password = $user->password;
	$user_entity->new_pass_token = $user->new_pass_token;
	$user_entity->mobile_phone = $user->mobile_phone;
	$user_entity->home_phone = $user->home_phone;
	$user_entity->office_phone = $user->office_phone;
	$user_entity->address = $user->address;

	return $user_entity;
    }

}

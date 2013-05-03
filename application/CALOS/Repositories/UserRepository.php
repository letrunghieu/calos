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
    
    /**
     * 
     * @param type $id
     * @return \CALOS\Entities\UserEntity
     */
    public static function find_by_id($id)
    {
	$user = \User::find($id);
	if ($user)
	{
	    $user_entity = static::convert_from_orm($user);
	    return $user_entity;
	}
	else
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
	    $user->first_name = $user_entity->first_name;
	    $user->last_name = $user_entity->last_name;
	    $user->email = $user_entity->email;
	    $user->password = $user_entity->password;
	    $user->new_pass_token = $user_entity->new_pass_token;
	    $user->mobile_phone = $user_entity->mobile_phone;
	    $user->home_phone = $user_entity->home_phone;
	    $user->office_phone = $user_entity->office_phone;
	    $user->address = $user_entity->address;
	    $user->gender = $user_entity->gender;

	    $user->save();
	    return true;
	}
	return false;
    }
    
    /**
     * Get the current user entity
     * 
     * @return \CALOS\Entities\UserEntity
     */
    public static function current_user()
    {
	if (\Auth::guest()){
	    return null;
	}else
	{
	    return static::convert_from_orm(\Auth::user());
	}
    }

    private static function convert_from_orm($user)
    {
	$user_entity = new \CALOS\Entities\UserEntity($user->id);
	
	$user_entity->display_name = $user->display_name ? $user->display_name : $user->first_name . " " . $user->last_name;
	$user_entity->first_name = $user->first_name;
	$user_entity->last_name = $user->last_name;
	$user_entity->email = $user->email;
	$user_entity->password = $user->password;
	$user_entity->new_pass_token = $user->new_pass_token;
	$user_entity->mobile_phone = $user->mobile_phone;
	$user_entity->home_phone = $user->home_phone;
	$user_entity->office_phone = $user->office_phone;
	$user_entity->address = $user->address;
	$user_entity->gender = $user->gender;

	return $user_entity;
    }

}

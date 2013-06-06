<?php

namespace CALOS\Services;

use CALOS\Entities\UserEntity;
use CALOS\Repositories\UserRepository;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserService
{

    public static function request_new_password(\CALOS\Entities\UserEntity $user)
    {
	$user->new_pass_token = sha1($user->password . time());
	if (\CALOS\Repositories\UserRepository::save($user))
	{
	    $mailer = \Laravel\IoC::resolve('phpmailer');
	    try
	    {
		$input = array(
		    'display_name' => $user->display_name,
		    'email' => $user->email,
		    'url' => \URL::to_route('renew_password', array($user->get_id(), $user->new_pass_token)),
		);

		$message = \Mailblade::make('password-restore', $input);
		$mailer->AddAddress("letrunghieu.cse09@gmail.com", "Hieu Le");
		$mailer->IsHTML(true);
		$mailer->Subject = __('auth.renew password email title');
		$mailer->Body = $message->html();
		$mailer->Send();
		
	    } catch (Exception $e)
	    {
		\Log::error('Mailer error: ' . $e->getMessage());
		return false;
	    }
	    return true;
	} else
	{
	    \Log::error('cannot save user');
	    return false;
	}
    }
    
    public static function update_password(UserEntity $user, $new_password)
    {
	$user->password = \Hash::make($new_password);
	if (UserRepository::save($user)){
	    return true;
	}
	else
	{
	    \Log::error('cannot save user when update password.');
	    return false;
	}
    }
    
    public static function is_user_has_roles(UserEntity $user_entity, $roles){
	$roles = (array)$roles;
	$user = \User::find($user_entity->get_id());
	return $user->has_any_role($roles);
    }
    
    public static function can_write_announcement($user_id)
    {
	return true;
    }

}

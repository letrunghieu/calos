<?php
use CALOS\Repositories\UserRepository;

class User_Controller extends Base_Controller {
    
    public function action_view_profile($user_id)
    {
	
	$data = array();
	
	$user = UserRepository::find_by_id($user_id);
	if ($user)
	{
	    $data['user'] = $user;
	}
	SEO::set_title("View profile of {$user->display_name}", false);
	return View::make('user.view_profile', $data);
    }
}
<?php

use CALOS\Repositories\UserRepository;

class User_Controller extends Base_Controller
{

    public function __construct()
    {
	parent::__construct();
	Asset::add('user_css', 'css/user.css');
    }

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

    public function action_edit_profile()
    {
	$data = array();
	$user = UserRepository::current_user();
	if (Input::get('update_profile'))
	{
	    foreach (Input::get('user') as $field => $value)
	    {
		$user->$field = $value;
	    }
	    if(UserRepository::save($user))
	    {
		$success = __('user.updated notification');
	    }
	}

	$data['user'] = $user;
	if(isset($success))
	    $data['success'] = $success;
	SEO::set_title("Edit your profile", false);
	return View::make('user.edit_profile', $data);
    }
    
    public function action_update_credential()
    {
	$data = array();
	$user = UserRepository::current_user();
	if (Input::get('update_credential'))
	{
	    $rules = array(
		'current_password' => 'required',
		'renew_password' => 'required_with:new_password|same:new_password',
		'renew_email' => 'required_with:new_email|same:new_email',
	    );
	    
	    $validation = Validator::make(Input::all(), $rules);
	    if ($validation->fails())
	    {
		var_dump($validation->errors);
	    }
	}
	$data['user'] = $user;
	SEO::set_title("Change email and password", false);
	return View::make('user.update_credential', $data);
    }

}
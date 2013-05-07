<?php

use CALOS\Repositories\UserRepository;
use CALOS\Repositories\MetaRepository;
use \CALOS\Repositories\OptionRepository;

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
	    if (UserRepository::save($user))
	    {
		$success = __('user.updated notification');
	    }
	}

	$data['user'] = $user;
	if (isset($success))
	    $data['success'] = $success;
	SEO::set_title("Edit your profile", false);
	return View::make('user.edit_profile', $data);
    }

    public function action_update_credential()
    {
	$data = array();
	$user = UserRepository::current_user();
	$validation_errors = array();
	if (Input::get('update_credential'))
	{
	    $rules = array(
		'current_password' => 'required',
		'renew_password' => 'required_with:new_password|same:new_password',
		'new_email' => 'email',
		'renew_email' => 'required_with:new_email|same:new_email',
	    );

	    $validation = Validator::make(Input::all(), $rules);
	    if ($validation->fails())
	    {
		# If there is a validation error
		if ($validation->errors->has('current_password'))
		{
		    # The current password is empty
		    $validation_errors['current_password'] = __('user.you must enter your current password');
		} else
		{
		    # Check the current password, if it is correct then check other fields
		    if (Hash::check(Input::get('current_password'), $user->password))
		    {
			# Check the new password and email
			if (Input::get('new_password'))
			{
			    if ($validation->errors->has('renew_password'))
			    {
				$validation_errors['renew_password'] = __('user.this field is not the same as your new password');
			    }
			}
			if (Input::get('new_email'))
			{
			    if ($validation->errors->has('new_email'))
			    {
				$validation_errors['new_email'] = __('user.this is not a valid email address');
			    }
			    if ($validation->errors->has('renew_email'))
			    {
				$validation_errors['renew_email'] = __('user.this field is not the same as your new email');
			    }
			}
		    } else
		    {
			$validation_errors['current_password'] = __('user.your current password is not correct');
		    }
		}
	    } else
	    {
		# There is no validation error
		if (Hash::check(Input::get('current_password'), $user->password))
		{
		    if (Input::get('new_password'))
		    {
			$user->password = Hash::make(Input::get('new_password'));
		    }
		    if (Input::get('new_email'))
		    {
			$user->email = Input::get('new_email');
		    }
		    if (UserRepository::save($user))
		    {
			$success = __('user.email and password updated successfully');
		    }
		} else
		{
		    $validation_errors['current_password'] = __('user.your current password is not correct');
		}
	    }
	}
	$data['user'] = $user;
	$data['validation_errors'] = $validation_errors;
	if (isset($success))
	    $data['success'] = $success;
	SEO::set_title("Change email and password", false);
	return View::make('user.update_credential', $data);
    }

    public function action_profile_fields()
    {
//	var_dump(Input::all());
	$data = array();

	$updated_fields = array();
	if (Input::get('update_fields'))
	{
	    $new_fields = Input::get('fields_new');
	    if (is_array($new_fields))
	    {
		foreach ($new_fields as $field)
		{
		    $title = trim($field['title']);
		    $type = $field['type'];
		    $description = isset($field['description']) ? trim($field['description']) : null;
		    $object = 'user';
		    $domain = null;
		    if (isset($field['domain']))
		    {
			$domain = explode('\n', trim($field['domain']));
			foreach ($domain as $k => $v)
			{
			    $domain[$k] = trim($domain[$k]);
			    if ($domain[$k] == '')
				unset($domain[$k]);
			}
		    }
		    $meta = MetaRepository::create_meta(Str::slug($title, "_") . "_" . time(), $title, $description, $type, $object, $domain);
		    if ($meta)
			$updated_fields[] = $meta->get_id();
		}
	    }
	    OptionRepository::update_option('profile_fields', serialize($updated_fields));
	}
	$current_fields = \CALOS\Repositories\OptionRepository::get_option('profile_fields');
	if (!$current_fields)
	    $current_fields = array();
	else
	    $current_fields = unserialize($current_fields);
	if (!is_array($current_fields))
	    $current_fields = array();
	$data['current_fields'] = $current_fields;
	if (isset($success))
	    $data['success'] = $success;
	Asset::container('footer')->add('jquery-ui', 'bundles/jqueryui/js/jquery-ui-1.10.3.custom.min.js', array('jquery'));
	Asset::container('footer')->add('', 'js/profile_fields.js', array('jquery'));
	Asset::add('jquery-ui_css', 'bundles/jqueryui/css/jquery-ui-1.10.3.custom.min.css');
	SEO::set_title("Current custom profile fields");
	return View::make('user.profile_fields', $data);
    }

}
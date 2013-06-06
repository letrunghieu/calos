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

    public function action_create()
    {
	$data = array();
	$validation_errors = array();
	if (Input::get('commit'))
	{
	    $rules = array(
		'password' => 'required',
		'repassword' => 'required_with:password|same:password',
		'email' => 'email',
	    );

	    $validation = Validator::make(Input::all(), $rules);
	    if ($validation->fails())
	    {
		# If there is a validation error
		if ($validation->errors->has('password'))
		{
		    # The current password is empty
		    $validation_errors['password'] = __('user.you must enter your current password');
		}
		if ($validation->errors->has('repassword'))
		{
		    $validation_errors['repassword'] = __('user.this field is not the same as your new password');
		}
		if ($validation->errors->has('email'))
		{
		    $validation_errors['email'] = __('user.this is not a valid email address');
		}
		$data['messages']['error'] = $validation_errors;
	    } else
	    {
		$user = UserRepository::create(trim(Input::get('email')), trim(Input::get('password')), trim(Input::get('first_name')), trim(Input::get('last_name')));
		if ($user)
		{
		    \CALOS\Repositories\OrganizationUnitRepository::add_member(Input::get('unit_id'), $user->id);
		    $data['messages']['success'][] = __('user.created successfully');
		} else
		{
		    $data['messages']['error'][] = __('user.cannot created');
		}
	    }
	}
	$data['units'] = \CALOS\Repositories\OrganizationUnitRepository::get_all_hierachy();
	SEO::set_title(__('user.create'));
	return View::make('user.create', $data);
    }

    public function action_view_profile($user_id)
    {

	$data = array();

	$user = UserRepository::find_by_id($user_id);
	if ($user)
	{
	    $data['user'] = $user;
	    $data['current_fields'] = $this->get_user_metas();
	    SEO::set_title("View profile of {$user->display_name}", false);
	    return View::make('user.view_profile', $data);
	}
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
	$data['current_fields'] = $this->get_user_metas();
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
	$data = array();

	$updated_fields = array();
	if (Input::get('update_fields'))
	{
	    $old_fields = Input::get('fields');
	    if (is_array($old_fields))
	    {
		foreach ($old_fields as $id => $field)
		{
		    $id = substr($id, strlen("item_"));
		    $title = trim($field['title']);
		    $type = $field['type'];
		    $description = isset($field['description']) ? trim($field['description']) : null;
		    $object = 'user';
		    $domain = null;
		    if (isset($field['domain']))
		    {
			$d = explode("\n", trim($field['domain']));
			$domain = array();
			foreach ($d as $v)
			{
			    $v = trim($v);
			    if ($v != '')
				$domain[$v] = $v;
			}
			$domain = serialize($domain);
		    }
		    if (isset($field['id']))
		    {
			#old fields
			$updated_fields[] = $id;
			$meta_entity = new \CALOS\Entities\MetaEntity($id);
			$meta_entity->title = $title;
			$meta_entity->key = Str::slug($title, "_") . "_" . time();
			$meta_entity->description = $description;
			$meta_entity->object = $object;
			$meta_entity->type = $type;
			if ($domain)
			{
			    $meta_entity->domain = $domain;
			}
			MetaRepository::update_meta($meta_entity);
		    } else
		    {
			# new fields;
			$meta = MetaRepository::create_meta(Str::slug($title, "_") . "_" . time(), $title, $description, $type, $object, $domain);
			if ($meta)
			    $updated_fields[] = $meta->get_id();
		    }
		}
	    }
	    OptionRepository::update_option('profile_fields', serialize($updated_fields));
	}

	$data['current_fields'] = $this->get_user_metas();
	if (isset($success))
	    $data['success'] = $success;
	Asset::container('footer')->add('jquery-ui', 'bundles/jqueryui/js/jquery-ui-1.10.3.custom.min.js', array('jquery'));
	Asset::container('footer')->add('', 'js/profile_fields.js', array('jquery'));
	Asset::add('jquery-ui_css', 'bundles/jqueryui/css/jquery-ui-1.10.3.custom.min.css');
	SEO::set_title("Current custom profile fields");
	return View::make('user.profile_fields', $data);
    }

    private function get_user_metas()
    {
	$current_fields = \CALOS\Repositories\OptionRepository::get_option('profile_fields');
	if (!$current_fields)
	    return array();
	else
	    $current_fields = unserialize($current_fields);
	if (!is_array($current_fields) || empty($current_fields))
	    return array();

	$fields = MetaRepository::find_by_multi_id($current_fields);
	$sorted_fields = array();
	foreach ($current_fields as $k)
	{
	    if (key_exists($k, $fields))
		$sorted_fields['item_' . $k] = $fields[$k];
	}
	$data['current_fields'] = $sorted_fields;
	return $sorted_fields;
    }

}
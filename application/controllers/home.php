<?php

class Home_Controller extends Base_Controller
{
    public function __construct()
    {
	parent::__construct();
	Asset::add('home_css', 'css/home.css');
    }
    /*
      |--------------------------------------------------------------------------
      | The Default Controller
      |--------------------------------------------------------------------------
      |
      | Instead of using RESTful routes and anonymous functions, you might wish
      | to use controllers to organize your application API. You'll love them.
      |
      | This controller responds to URIs beginning with "home", and it also
      | serves as the default controller for the application, meaning it
      | handles requests to the root of the application.
      |
      | You can respond to GET requests to "/home/profile" like so:
      |
      |		public function action_profile()
      |		{
      |			return "This is your profile!";
      |		}
      |
      | Any extra segments are passed to the method as parameters:
      |
      |		public function action_profile($id)
      |		{
      |			return "This is the profile for user {$id}.";
      |		}
      |
     */

    public function action_index()
    {
	$current_user = \CALOS\Repositories\UserRepository::current_user();
	$data = array();
	$data['org'] = CALOS\Repositories\OrganizationUnitRepository::get_organizaion();
	$data['announcements'] = CALOS\Repositories\AnnouncementRepository::get_latest($current_user->id);
	
	SEO::set_title($data['org']->name);
	return View::make('home.index', $data);
    }

    public function action_login()
    {
	$email = Input::get('email');
	$password = Input::get('password');
	$remember = Input::get('remember');
	if ($email !== NULL && $password !== NULL)
	{
	    $credentials = array('username' => $email, 'password' => $password, 'remember' => ($remember != NULL));

	    if (Auth::attempt($credentials))
	    {
		return Redirect::to_route('home');
	    }
	    else
	    {
		$error = __('auth.login error');
	    }
	}
	$data = array();
	if (isset($error))
	    $data['error'] = $error;
	SEO::set_title("Log in");
	return View::make('home.login', $data);
    }
    
    public function action_logout()
    {
	if (!Auth::guest())
	{
	    Auth::logout();
	}
	return Redirect::to_route('login');
    }
    
    public function action_forgot_password()
    {
	$email = Input::get('email');
	
	if($email)
	{
	    $user = \CALOS\Repositories\UserRepository::find_by_email($email);
	    if ($user)
	    {
		if (\CALOS\Services\UserService::request_new_password($user))
		{
		    $success = __('auth.recovery email has been sent to your email!');
		}
		else
		{
		    $error = __('error.unknown error');
		}
	    }
	    else
	    {
		$error = __('auth.cannot find this email in our database!');
	    }
	}
	
	$data = array();
	if (isset($error))
	    $data['error'] = $error;
	if (isset($success))
	    $data['success'] = $success;
	SEO::set_title("Recover password");
	return View::make('home.forgot_password', $data);
    }
    
    public function action_renew_password($user_id, $renew_token)
    {
	$new_password = Input::get('password');
	$renew_password = Input::get('re_password');
	if ($new_password && $renew_password)
	{
	    if ($new_password != $renew_password){
		$error = __('auth.the two password are not match');
	    }
	    else
	    {
		$user = \CALOS\Repositories\UserRepository::find_by_id($user_id);
		if ($user && $user->new_pass_token == $renew_token)
		{
		    if (\CALOS\Services\UserService::update_password($user, $new_password))
		    {
			$success = __('auth.your password has been renew!');
		    }
		    else
		    {
			$error = __('error.unknown error');
		    }
		}
		else
		{
		    $error = __('auth.cannot find the user');
		}
	    }
	}
	$data = array();
	if (isset($error))
	    $data['error'] = $error;
	if (isset($success))
	    $data['success'] = $success;
	SEO::set_title("Renew password");
	return View::make('home.renew_password', $data);
    }

}
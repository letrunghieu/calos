<?php

class Home_Controller extends Base_Controller
{
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
	return View::make('home.index');
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
	$data = array();
	if (isset($error))
	    $data['error'] = $error;
	return View::make('home.forgot_password', $data);
    }

}
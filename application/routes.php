<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
  | breeze to setup your application using Laravel's RESTful routing and it
  | is perfectly suited for building large applications and simple APIs.
  |
  | Let's respond to a simple GET request to http://example.com/hello:
  |
  |		Route::get('hello', function()
  |		{
  |			return 'Hello World!';
  |		});
  |
  | You can even respond to more than one URI:
  |
  |		Route::post(array('hello', 'world'), function()
  |		{
  |			return 'Hello World!';
  |		});
  |
  | It's easy to allow URI wildcards using (:num) or (:any):
  |
  |		Route::put('hello/(:any)', function($name)
  |		{
  |			return "Welcome, $name.";
  |		});
  |
 */

Route::get('/', array('as' => 'home', 'uses' => 'home@index'));

Route::any('/login', array('as' => 'login', 'uses' => 'home@login'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'home@logout'));
Route::any('/forgot_password', array('as' => 'forgot_password', 'uses' => 'home@forgot_password'));
Route::any('/renew_password/(:num)/(:any)', array('as' => 'renew_password', 'uses' => 'home@renew_password'));

Route::controller(array('user', 'organization'));

/*
  |--------------------------------------------------------------------------
  | Application 404 & 500 Error Handlers
  |--------------------------------------------------------------------------
  |
  | To centralize and simplify 404 handling, Laravel uses an awesome event
  | system to retrieve the response. Feel free to modify this function to
  | your tastes and the needs of your application.
  |
  | Similarly, we use an event to handle the display of 500 level errors
  | within the application. These errors are fired when there is an
  | uncaught exception thrown in the application. The exception object
  | that is captured during execution is then passed to the 500 listener.
  |
 */

Event::listen('404', function()
	{
	    return Response::error('404');
	});

Event::listen('500', function($exception)
	{
	    return Response::error('500');
	});

/*
  |--------------------------------------------------------------------------
  | Route Filters
  |--------------------------------------------------------------------------
  |
  | Filters provide a convenient method for attaching functionality to your
  | routes. The built-in before and after filters are called before and
  | after every request to your application, and you may even create
  | other filters that can be attached to individual routes.
  |
  | Let's walk through an example...
  |
  | First, define a filter:
  |
  |		Route::filter('filter', function()
  |		{
  |			return 'Filtered!';
  |		});
  |
  | Next, attach the filter to a route:
  |
  |		Route::get('/', array('before' => 'filter', function()
  |		{
  |			return 'Hello World!';
  |		}));
  |
 */

Route::filter('before', function()
	{
	    // Do stuff before every request to your application...
	    $no_auth_routes = array(
		URL::to_route('login'),
		URL::to_route('logout'),
		URL::to_route('forgot_password'),
	    );

	    if ((!in_array(URL::current(), $no_auth_routes) && !Request::route()->is('renew_password') ) && Auth::guest())
		return Redirect::to('login');
	});

Route::filter('after', function($response)
	{
	    # disable timestamps columns on pivot tables
	    Laravel\Database\Eloquent\Pivot::$timestamps = false;

	    $current_user = \CALOS\Repositories\UserRepository::current_user();
	    // Do stuff after every request to your application...
	    Asset::add('bootstrap_css', 'bootstrap-awesome/css/bootstrap.css');
	    Asset::add('bootstrap_resp_css', 'bootstrap-awesome/css/bootstrap-responsive.css');
	    Asset::add('common_css', 'css/common.css');
	    Asset::add('auth_css', 'css/auth.css');
	    Asset::container('footer')->add('jquery', 'bootstrap-awesome/js/jquery-1.9.1.min.js');
	    Asset::container('footer')->add('bootstrap_js', 'bootstrap-awesome/js/bootstrap.min.js');
	    Asset::container('footer')->add('common_js', 'js/common.js');

	    # create global topbar
	    if (!Auth::guest())
	    {
		$user_item = " <b class='caret'></b>"
			. CALOS\Repositories\UserRepository::current_user()->display_name . " <img class='gravatar' src='"
			. Gravitas\API::url(\CALOS\Repositories\UserRepository::current_user()->email, 24)
			. "' alt='' />";
		\Navigation\Navigation::make('topbar')
			->add_link("Activities", '', false, array(), null, 'activities_menu')
			->add_link(__('organization.organization'), '', false, array(
			    'element_attribs' => array('class' => 'dropdown'),
			    'link_attribs' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
				), Navigation\Navigation::make('organization_sub_nav', array(), false)
				->add_link("<i class='icon-folder'></i> " . __('organization.view our organization structure'), URL::to_action("organization"))
				->add_link("<i class='icon-folder'></i> " . __('organization.view your vacancies'), URL::to_action("organization"))
				, 'organization_menu')
			->add_link("Documents", '', false, array(), null, 'documents_menu')
			->add_link("Announcements", '', false, array(), null, 'announcements_menu')
			->add_link("Tools", '', false, array(
			    'element_attribs' => array('class' => 'dropdown'),
			    'link_attribs' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
				), null, 'tools_menu')
			->add_link($user_item, '', false, array(
			    'element_attribs' => array('class' => 'dropdown'),
			    'link_attribs' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
				)
				, Navigation\Navigation::make('user_sub_nav', array(), false)
				->add_link("<i class='icon-suitcase'></i> " . __('user.view profile label'), URL::to_action("user@view_profile", array($current_user->get_id())))
				->add_link("<i class='icon-edit'></i> " . __('user.edit profile label'), URL::to_action("user@edit_profile"))
				->add_link("<i class='icon-keyboard'></i> " . __('user.change email and password label'), URL::to_action("user@update_credential"))
				->add_link("<i class='icon-signout'></i> " . __('auth.log out label'), URL::to_route('logout'))
				, 'user_menu')
		;

		if (\CALOS\Services\UserService::is_user_has_roles($current_user, array('administrator', 'personel_manager')))
		{
		    \Navigation\Navigation::get('topbar')->find_item('tools_menu')
			    ->make_child()
			    ->add_link("" . __('user.view list label'), URL::to_action('user@list'))
			    ->add_link("" . __('user.profile fields'), URL::to_action('user@profile_fields'))
		    ;
		}

//		var_dump(Auth::user()->metas()->first()->relationships['pivot']->meta_value);
	    }
	});

Route::filter('csrf', function()
	{
	    if (Request::forged())
		return Response::error('500');
	});

Route::filter('auth', function()
	{
	    if (Auth::guest())
		return Redirect::to('login');
	});
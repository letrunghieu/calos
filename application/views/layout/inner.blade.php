<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        {{SEO::headers()}}
        <meta name="viewport" content="width=device-width">

        {{Asset::styles()}}
        {{Asset::container('gumby')->styles()}}

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

	<div id='wrap0'>
	    <div id="topbar" class="navbar container">
		<div class="row">
		    <!-- Toggle for mobile navigation, targeting the <ul> -->
		    <a class="toggle" gumby-trigger="#main-nav" href="#"><i class="icon-menu"></i></a>
		    <h1 class="four columns logo">
			<a href="{{ URL::home() }}">
			    <img src="{{ URL::home() }}img/calos_logo.png" gumby-retina/>
			</a>
		    </h1>
		    <div class='ten columns pull_right'>
			<ul id='main-nav'>
			    <li>
				<a href='#'>Activities</a>
			    </li>
			    <li>
				<a href='#'>Organization</a>
			    </li>
			    <li>
				<a href='#'>Documents</a>
			    </li>
			    <li>
				<a href='#'>Announcements</a>
			    </li>
			    <li>
				<a href='#'>
				    <i class='icon-down-open-big'></i>
				    <span>{{ \CALOS\Repositories\UserRepository::current_user()->display_name }}</span>
				    <img class='gravatar' src='<?php echo Gravitas\API::url(\CALOS\Repositories\UserRepository::current_user()->email, 40) ?>' alt='' /> 
				</a>
				<div class='dropdown'>
				    <ul>
					<li>
					    <a href='{{ URL::to_action("user@view_profile", array($current_user->get_id())) }}'>
						<i class='icon-suitcase'></i> {{__('user.view profile label')}}
					    </a>
					</li>
					<li>
					    <a href='{{ URL::to_action("user@edit_profile") }}'>
						<i class='icon-brush'></i> {{__('user.edit profile label')}}
					    </a>
					</li>
					<li>
					    <a href='{{ URL::to_action("user@update_credential") }}'>
						<i class='icon-keyboard'></i> {{__('user.change email and password label')}}
					    </a>
					</li>
					<li>
					    <a href='{{ URL::to_action("admin.home@index") }}'>
						<i class='icon-cog'></i> {{__('user.to control panel')}}
					    </a>
					</li>
					<li>
					    <a href='{{ URL::to_route('logout') }}'>
					       <i class='icon-logout'></i> {{__('auth.log out label')}}
					    </a>
					</li>
				    </ul>
				</div>
			    </li>
			</ul>
		    </div>
		</div>
	    </div>
	    <div id='page-content'>
		@yield('page-content')
	    </div>
	</div>

	{{ Asset::container('gumby')->scripts() }}
	{{ Asset::container('footer')->scripts() }}


        <script>
//            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
//            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
//            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
//            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>

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

        <!--<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
    </head>
    <body id='inner-doc'>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

	<div id='wrap0'>
	    <div class="navbar navbar-inverse navbar-fixed-top" id='topbar'>
		<div class="navbar-inner">
		    <div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			</a>
			<a href="{{ URL::home() }}" class="brand logo">
			    <img src="{{ URL::home() }}img/calos_logo.png" gumby-retina/>
			</a>
			<div class="nav-collapse collapse">
			    <?php
			    $options = array(
				array(
				    'element_attribs' => array(
					'id' => 'main-nav',
					'class' => 'pull-right nav'
				    ),
				),
				array(
				    'element_attribs' => array(
					'class' => 'dropdown-menu'
				    ),
				),
			    );
			    echo Navigation\Navigation::get('topbar')->render($options);
			    ?>
			</div><!--/.nav-collapse -->
		    </div>
		</div>
	    </div>
	    <div id='page-content'>
		@yield('page-content')
	    </div>
	    <div id='messages'>
		@yield('message')
	    </div>

	    <div class='shaded'>
		<footer class="container" id="site-footer">
		    <div class="row">
			<div class="logo span6">
			    <a href="{{ URL::home() }}">
				<img src="{{ URL::home() }}img/calos_logo_dark.png" gumby-retina />
			    </a>
			</div>
			<div class='span6 text-right'>
			    <p class="copyright">Powered by CALOS system @ 2013</p>
			</div>

		    </div>
		</footer>
	    </div>
	</div>

	{{ Asset::container('footer')->scripts() }}
	@yield('foot_scripts')


        <script>
//            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
//            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
//            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
//            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>

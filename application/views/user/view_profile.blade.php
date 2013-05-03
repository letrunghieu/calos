@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id='profile' class='page container'>
    @if(isset($user))
    <div class='row'>
	<h2>{{__($user->display_name)}}</h2>
    </div>
    <div class='row'>
	<div class='ten columns' id='content'>
	    <section>
		<div class='nine columns'>
		    <h3>Basic information</h3>
		    <p>
			<strong class='key'>Email:</strong> <span class='value'>{{$current_user->email}}</span>
		    </p>
		    <p>
			<strong class='key'>Address:</strong> <span class='value'>{{$current_user->address}}</span>
		    </p>
		    <p>
			<strong class='key'>Mobile:</strong> <span class='value'>{{$current_user->mobile_phone}}</span>
		    </p>
		    <p>
			<strong class='key'>Office phone:</strong> <span class='value'>{{$current_user->office_phone}}</span>
		    </p>
		    <p>
			<strong class='key'>Home phone:</strong> <span class='value'>{{$current_user->home_phone}}</span>
		    </p>
		    <div class="medium default btn icon-left icon-brush" >
			<a href='{{ URL::to_action("user@edit_profile") }}'>
			    {{__('user.edit profile label')}}
			</a>
		    </div>
		</div>
		<div class='five columns'>
		    <img class='gravatar profile-avatar pull_right' src='{{Gravitas\API::url($current_user->email, 200)}}' alt='' />
		</div>
	    </section>
	    <div class='clearfix'></div>
	    <hr />
	    <section>
		<h3>Further information</h3>
	    </section>
	</div>
	<div class='four columns'>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	    <p>a</p>
	</div>
    </div>
    @else
    <div class='row'>
	<h2>{{__('user.empty profile page header')}}</h2>
    </div>
    @endif
</div>
@endsection
@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id='profile' class='page container'>
    @if(isset($user))
    <div class='row'>
	<h2 class='span12'>{{__('user.change email and password label')}}</h2>
    </div>
    <div class='row'>
	<form method="post" action="{{ URL::current() }}" id='basic_info'>
	    <div class='span9' id='content'>
		@if (isset($success))
		<p class='alert alert-success'>
		    {{$success}}
		</p>
		@endif

		<section>
		    <h3>{{__('user.current password label')}}</h3>

		    <p class='field'>
			{{Form::label('current_password', __('user.current password guide'))}}
			<span {{isset($validation_errors['current_password']) ? "class='danger'" : ""}}>
			    {{Form::password('current_password', array('class'=>'wide input password'))}}
			</span>
		    </p>
		    @if (isset($validation_errors['current_password']))
		    <p class='danger alert'>
			{{$validation_errors['current_password']}}
		    </p>
		    @endif
		</section>
		<section>
		    <h3>{{__('user.change password label')}}</h3>
		    <p class='field'>
			{{Form::label('new_password', __('user.type new password guide'))}}
			{{Form::password('new_password', array('class'=>'wide input password'))}}
		    </p>

		    <p class='field'>
			{{Form::label('renew_password', __('user.retype new password guide'))}}
			<span {{isset($validation_errors['renew_password']) ? "class='danger'" : ""}}>
			    {{Form::password('renew_password', array('class'=>'wide input password'))}}
			</span>
		    </p>
		    @if (isset($validation_errors['renew_password']))
		    <p class='danger alert'>
			{{$validation_errors['renew_password']}}
		    </p>
		    @endif
		</section>
		<section>
		    <h3>{{__('user.change email label')}}</h3>
		    <p class="field">
			{{Form::label('new_email', __('user.type new email label'))}}
			<span {{isset($validation_errors['new_email']) ? "class='danger'" : ""}}>
			    {{Form::text('new_email', '', array('class'=>'wide input text'))}}
			</span>
		    </p>
		    @if (isset($validation_errors['new_email']))
		    <p class='danger alert'>
			{{$validation_errors['new_email']}}
		    </p>
		    @endif

		    <p class="field">
			{{Form::label('renew_email', __('user.retype new email label'))}}
			<span {{isset($validation_errors['renew_email']) ? "class='danger'" : ""}}>
			    {{Form::text('renew_email', '', array('class'=>'wide input text'))}}
			</span>
		    </p>
		    @if (isset($validation_errors['renew_email']))
		    <p class='danger alert'>
			{{$validation_errors['renew_email']}}
		    </p>
		    @endif
		</section>
		<p>
		    <input class='btn btn-primary' type='submit' name='update_credential'  value='{{__('user.update credential label')}}'/>
		</p>

		<div class='clearfix'></div>
	    </div>
	    <div class='span3'>
		<div class="vertical-nav">
		    <ul class="nav nav-tabs nav-stacked">
			<li>
			    <a href='{{ URL::to_action("user@view_profile", array($user->get_id())) }}'>
				{{__('user.view profile label')}}
			    </a>
			</li>
			<li>
			    <a href='{{ URL::to_action("user@edit_profile") }}'>
				{{__('user.edit profile label')}}
			    </a>
			</li>
		    </ul>
		</div>

	    </div>
	</form>
    </div>
    @else
    <div class='row'>
	<h2>{{__('user.empty profile page header')}}</h2>
    </div>
    @endif
</div>
@endsection
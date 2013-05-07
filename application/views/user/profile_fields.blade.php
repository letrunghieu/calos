@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id='profile' class='page container'>
    <div class='row'>
	<h2>{{__('user.current custom profile field label')}}</h2>
    </div>
    <div class='row'>
	<div class='ten columns' id='content'>
	    @if (isset($success))
	    <p class='success alert'>
		{{$success}}
	    </p>
	    @endif
	    <form method="post" action="{{ URL::current() }}" id='basic_info'>
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
		<div class="medium primary btn icon-left entypo icon-check" >
		    <input type='submit' name='update_credential'  value='{{__('user.update credential label')}}'/>

		</div>
	    </form>
	    <div class='clearfix'></div>
	    <hr />
	    <section>
		<h3>Further information</h3>
	    </section>
	</div>
	<div class='four columns'>
	</div>
    </div>
</div>
@endsection
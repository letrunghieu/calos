@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id='profile' class='page container'>
    @if(isset($user))
    <div class='row'>
	<h2>{{__('user.change email and password label')}}</h2>
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
			{{Form::password('current_password', array('class'=>'wide input password'))}}
		    </p>
		</section>
		<section>
		    <h3>{{__('user.change password label')}}</h3>
		    <p class='field'>
			{{Form::label('new_password', __('user.type new password guide'))}}
			{{Form::password('new_password', array('class'=>'wide input password'))}}
		    </p>
		    <p class='field'>
			{{Form::label('renew_password', __('user.retype new password guide'))}}
			{{Form::password('renew_password', array('class'=>'wide input password'))}}
		    </p>
		</section>
		<section>
		    <h3>{{__('user.change email label')}}</h3>
		    <p class="field">
			{{Form::label('new_email', __('user.type new email label'))}}
			{{Form::text('new_email', '', array('class'=>'wide input text'))}}
		    </p>
		    <p class="field">
			{{Form::label('renew_email', __('user.retype new email label'))}}
			{{Form::text('renew_email', '', array('class'=>'wide input text'))}}
		    </p>
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
    @else
    <div class='row'>
	<h2>{{__('user.empty profile page header')}}</h2>
    </div>
    @endif
</div>
@endsection
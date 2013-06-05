@layout('layout.common')

@section('page-content')
<div id='login' class='page valign' >
    <div class="shaded">
	<div class='container'>
	    <div class='row'>
		<div class='span8'>
		    <h1>{{__('auth.login title')}}</h1>
		    <p>
			{{__('auth.login page guide')}}
		    </p>
		    <p>
			{{HTML::link('forgot_password', ucfirst(__('auth.forgot your password?'))) }}
		    </p>
		</div>
		<div class='span4'>
		    {{Form::open()}}
		    <p class='field'>
			<?php // ucf ?>
			{{Form::label('email', ucfirst(__('auth.your email')))}}
			{{Form::text('email', '', array('class'=>'input-block-level'))}}
		    </p>
		    <p class='field'>
			{{Form::label('password', ucfirst(__('auth.your password')))}}
			{{Form::password('password', array('class'=>'input-block-level'))}}
		    </p>
		    <p class="field">
			<label class="checkbox">
			    {{Form::checkbox('remember')}} {{__('auth.remember me')}}
			</label>
		    </p>
		    <p>
			{{Form::submit(__('auth.log in label'), array('name' => 'login', 'class' => 'btn btn-primary input-block-level'))}}
		    </p>
		    {{Form::close()}}
		    @if (isset($error))
		    <p class='alert alert-error'>
			{{$error}}
		    </p>
		    @endif
		</div>
	    </div>
	</div>
    </div>
</div>
@endsection


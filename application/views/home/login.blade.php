@layout('layout.common')

@section('page-content')
<div id='login' class='page valign' >
    <div class='container shaded'>
	<div class='row'>
	    <div class='nine columns'>
		<h1>{{__('auth.login title')}}</h1>
		<p>
		    {{__('auth.login page guide')}}
		</p>
		<p>
		    {{HTML::link('forgot_password', ucfirst(__('auth.forgot your password?'))) }}
		</p>
	    </div>
	    <div class='five columns'>
		{{Form::open()}}
		<p class='field'>
		    <?php // ucf ?>
		    {{Form::label('email', ucfirst(__('auth.your email')))}}
		    {{Form::text('email', '', array('class'=>'input text'))}}
		</p>
		<p class='field'>
		    {{Form::label('password', ucfirst(__('auth.your password')))}}
		    {{Form::password('password', array('class'=>'input password'))}}
		</p>
		<p class="field">
		    <label class="checkbox">
			{{Form::checkbox('remember')}} {{__('auth.remember me')}}
		    </label>
		</p>
		<div class='field row clearfix'>
		    <div class='medium primary btn fourteen columns'>
			{{Form::submit(__('auth.log in label'), array('name' => 'login'))}}
		    </div>
		</div>
		{{Form::close()}}
		@if (isset($error))
		<p class='danger alert'>
		    {{$error}}
		</p>
		@endif
	    </div>
	</div>
    </div>
</div>
@endsection


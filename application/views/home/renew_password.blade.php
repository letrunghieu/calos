@layout('layout.common')

@section('page-content')
<div id='login' class='page valign' >
    <div class='container shaded'>
	<div class='row'>
	    <div class='nine columns'>
		<h1>{{__('auth.renew password title')}}</h1>
		<p>
		    {{__('auth.renew page guide')}}
		</p>
		<p>
		    {{HTML::link('login', __('auth.login with your credential')) }}
		</p>
	    </div>
	    <div class='five columns'>
		{{Form::open()}}
		<p class='field'>
		    {{Form::label('password', __('auth.your new password'))}}
		    {{Form::password('password', array('class'=>'input password'))}}
		</p>
		<p class='field'>
		    {{Form::label('re_password', __('auth.retype new password'))}}
		    {{Form::password('re_password', array('class'=>'input password'))}}
		</p>
		<div class='field row'>
		    <div class='medium primary btn fourteen columns'>
			{{Form::submit(__('auth.change my password'), array('name' => 'change_password'))}}
		    </div>
		</div>
		{{Form::close()}}
		@if (isset($error))
		<p class='danger alert'>
		    {{$error}}
		</p>
		@endif
		@if (isset($success))
		<p class='success alert'>
		    {{$success}}
		</p>
		@endif
	    </div>
	</div>
    </div>
</div>
@endsection
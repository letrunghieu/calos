@layout('layout.common')

@section('page-content')
<div id='login' class='page valign' >
    <div class='shaded'>
	<div class='container'>
	    <div class='row'>
		<div class='span8'>
		    <h1>{{__('auth.renew password title')}}</h1>
		    <p>
			{{__('auth.renew page guide')}}
		    </p>
		    <p>
			{{HTML::link('login', __('auth.login with your credential')) }}
		    </p>
		</div>
		<div class='span4'>
		    {{Form::open()}}
		    <p class='field'>
			{{Form::label('password', __('auth.your new password'))}}
			{{Form::password('password', array('class'=>'input-block-level'))}}
		    </p>
		    <p class='field'>
			{{Form::label('re_password', __('auth.retype new password'))}}
			{{Form::password('re_password', array('class'=>'input-block-level'))}}
		    </p>
		    <p>
			{{Form::submit(__('auth.change my password'), array('name' => 'change_password', 'class'=>'btn btn-primary'))}}
		    </p>
		    {{Form::close()}}
		    @if (isset($error))
		    <p class='alert alert-error'>
			{{$error}}
		    </p>
		    @endif
		    @if (isset($success))
		    <p class='alert alert-success'>
			{{$success}}
		    </p>
		    @endif
		</div>
	    </div>
	</div>
    </div>
</div>
@endsection
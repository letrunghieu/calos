@layout('layout.common')

@section('page-content')
<div id='login' class='page valign' >
    <div class='shaded'>
	<div class='container'>
	    <div class='row'>
		<div class='span8'>
		    <h1>{{__('auth.recover password title')}}</h1>
		    <p>
			{{__('auth.recover page guide')}}
		    </p>
		    <p>
			{{HTML::link('login', ucfirst(__('auth.login with your credential'))) }}
		    </p>
		</div>
		<div class='span4'>
		    {{Form::open()}}
		    <p class='field'>
			<?php // ucf ?>
			{{Form::label('email', ucfirst(__('auth.your email')))}}
			{{Form::text('email', '', array('class'=>'input-block-level'))}}
		    </p>
		    <p>
			{{Form::submit(ucfirst(__('auth.recover my password')), array('name' => 'recover_password', 'class' => 'btn btn-primary'))}}
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
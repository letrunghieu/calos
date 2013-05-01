@layout('layout.common')

@section('page-content')
<div id='login' class='page valign' >
    <div class='container shaded'>
	<div class='row'>
	    <div class='nine columns'>
		<h1>{{__('auth.recover password title')}}</h1>
		<p>
		    {{__('auth.recover page guide')}}
		</p>
		<p>
		    {{HTML::link('login', ucfirst(__('auth.login with your credential'))) }}
		</p>
	    </div>
	    <div class='five columns'>
		{{Form::open()}}
		<p class='field'>
		    <?php // ucf ?>
		    {{Form::label('email', ucfirst(__('auth.your email')))}}
		    {{Form::text('email', '', array('class'=>'input text'))}}
		</p>
		<div class='field row'>
		    <div class='medium primary btn fourteen columns'>
			{{Form::submit(ucfirst(__('auth.recover my password')), array('name' => 'recover_password'))}}
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
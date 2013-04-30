@layout('layout.common')

@section('page-content')
<div id='login' class='page valign' >
    <div class='container shaded'>
	<div class='row'>
	    <div class='eight columns'>
		<h1>{{__('auth.login title')}}</h1>
	    </div>
	    <div class='four columns'>
		{{Form::open()}}
		<p class='field'>
		    <?php // ucf ?>
		    {{Form::label('email', ucfirst(__('auth.your email')))}}
		    {{Form::text('email', '', array('class'=>'input text'))}}
		</p>
		<p class='field'>
		    {{Form::label('password', ucfirst(('auth.your password')))}}
		    {{Form::password('password', array('class'=>'input password'))}}
		</p>
		<p class='field'>
		    <label class='checkbox'>
			{{Form::checkbox('remember')}} <span></span> {{ucfirst(__('auth.remember me'))}}
		    </label>
		</p>
		<div class='field row'>
		    <div class='medium primary btn fourteen columns'>
			{{Form::submit(ucfirst(__('auth.login')), array('name' => 'login'))}}
		    </div>
		</div>
		{{Form::close()}}
	    </div>
	</div>
    </div>
</div>
@endsection


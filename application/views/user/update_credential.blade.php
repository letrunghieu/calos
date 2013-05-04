@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id='profile' class='page container'>
    @if(isset($user))
    <div class='row'>
	<h2>{{__('user.edit profile label')}}</h2>
    </div>
    <div class='row'>
	<div class='ten columns' id='content'>
	    <section>
		<h3>Basic information</h3>
		@if (isset($success))
		<p class='success alert'>
		    {{$success}}
		</p>
		@endif
		<p>
		    <em>{{__('user.edit gravtar guide')}}</em>
		</p>
		<form method="post" action="{{ URL::current() }}" id='basic_info'>
		    <p class="field">
			{{Form::label('user[display_name]', __('user.display name label'))}}
			{{Form::text('user[display_name]', $user->display_name, array('class'=>'xwide input text', 'id' => null))}}
		    </p>
		    <div class='row'>
			<div class='five columns'>
			    <p class="field">
				{{Form::label('user[first_name]', __('user.first name label'))}}
				{{Form::text('user[first_name]', $user->display_name, array('class'=>'input text', 'id' => null))}}
			    </p>
			</div>
			<div class='five columns'>
			    <p class="field">
				{{Form::label('user[last_name]', __('user.last name label'))}}
				{{Form::text('user[last_name]', $user->display_name, array('class'=>'input text', 'id' => null))}}
			    </p>
			</div>
		    </div>
		    <p>
			{{Form::label('user[gender]', __('user.gender label'))}}

			<span class='four columns'>
			    {{Form::radio('user[gender]', 1, ($user->gender)  ,array('id' => null))}}  {{__('user.male')}}
			</span>
			<span class='four columns'>
			    {{Form::radio('user[gender]', 0, (!$user->gender)  ,array( 'id' => null))}} {{__('user.female')}}
			</span>


		    </p>
		    <div class='clearfix'></div>
		    <p class="field">
			{{Form::label('user[address]', __('user.address label'))}}
			{{Form::textarea('user[address]', $user->address, array('class'=>'xwide input textarea', 'id' => null))}}
		    </p>
		    <p class="field">
			{{Form::label('user[mobile_phone]', __('user.mobile phone label'))}}
			{{Form::text('user[mobile_phone]', $user->mobile_phone, array('class'=>'wide input text', 'id' => null))}}
		    </p>
		    <p class="field">
			{{Form::label('user[office_phone]', __('user.office phone label'))}}
			{{Form::text('user[office_phone]', $user->office_phone, array('class'=>'wide input text', 'id' => null))}}
		    </p>
		    <p class="field">
			{{Form::label('user[home_phone]', __('user.home phone label'))}}
			{{Form::text('user[home_phone]', $user->home_phone, array('class'=>'wide input text', 'id' => null))}}
		    </p>
		    <div class='row'>
			<div class='pull_left'>
			    <div class="medium primary btn icon-left entypo icon-check" >
				<input type='submit' name='update_profile'  value='{{__('user.update profile label')}}'/>

			    </div>
			</div>
			<div class='pull_left margin-left'>
			    <div class="medium default btn icon-left entypo icon-suitcase" >
				<a href='{{ URL::to_action("user@view_profile", array($user->get_id())) }}'>
				    {{__('user.view profile label')}}
				</a>
			    </div>
			</div>
			<div class='pull_right'>
			    <div class="medium default btn icon-left entypo icon-keyboard" >
				<a href='{{ URL::to_action("user@update_credential") }}'>
				    {{__('user.change email and password label')}}
				</a>
			    </div>
			</div>
		    </div>
		</form>


	    </section>
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
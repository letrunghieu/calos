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
	<form method="post" action="{{ URL::current() }}" id='basic_info'>
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

		    <p class="field">
			{{Form::label('user[display_name]', __('user.display name label'))}}
			{{Form::text('user[display_name]', $user->display_name, array('class'=>'xwide input text', 'id' => null))}}
		    </p>
		    <div class='row'>
			<div class='five columns'>
			    <p class="field">
				{{Form::label('user[first_name]', __('user.first name label'))}}
				{{Form::text('user[first_name]', $user->first_name, array('class'=>'input text', 'id' => null))}}
			    </p>
			</div>
			<div class='five columns'>
			    <p class="field">
				{{Form::label('user[last_name]', __('user.last name label'))}}
				{{Form::text('user[last_name]', $user->last_name, array('class'=>'input text', 'id' => null))}}
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
		</section>
		<div class='clearfix'></div>
		<hr />
		<section>
		    <h3>Further information</h3>
		    <div>
			@foreach($current_fields as $field)
			<div class="custom {{$field->type}}">
			    <div class="field">
				{{Form::label('user[meta][' . $field->key .']', $field->title)}}
				@if ($field->description)
				{{Form::label('user[meta][' . $field->key .']', $field->description, array('class' => 'description'))}}
				@endif
				@if ($field->type == \CALOS\Entities\MetaEntity::TYPE_TEXT)
				{{Form::text('user['. $field->key .']', '', array('class'=>'wide input text'))}}
				@elseif($field->type == \CALOS\Entities\MetaEntity::TYPE_TEXTAREA)
				{{Form::textarea('user['. $field->key .']', '', array('class'=>'xwide input textarea'))}}
				@elseif($field->type == \CALOS\Entities\MetaEntity::TYPE_SELECT_SINGLE)
				<div class="picker wide">
				    {{Form::select('user['. $field->key .']', unserialize($field->domain))}}
				</div>

				@elseif($field->type == \CALOS\Entities\MetaEntity::TYPE_SELECT_MULTI)
				@foreach(unserialize($field->domain) as $k => $v)
				<label class="checkbox checked">
				    {{Form::checkbox('user['. $field->key .'][]', $k)}}
				    {{$v}}
				</label>
				@endforeach
				@endif
			    </div>
			</div>
			@endforeach
		    </div>
		</section>
	    </div>
	    <div class='four columns'>
		<div  gumby-fixed="80">
		    <div class='row'>
			<div class="large primary btn" >
			    <input type='submit' name='update_profile'  value='{{__('user.update profile label')}}'/>
			</div>
			<div class="vertical-nav">
			    <ul class="nopad">
				<li>
				    <a href='{{ URL::to_action("user@view_profile", array($user->get_id())) }}'>
					{{__('user.view profile label')}}
				    </a>
				</li>
				<li>
				    <a href='{{ URL::to_action("user@update_credential") }}'>
					{{__('user.change email and password label')}}
				    </a>
				</li>
			    </ul>
			</div>
		    </div>
		</div>
	    </div>
	</form>
    </div>
    @else
    <div class='row'>
	<h2>{{__('user.empty profile page header')}}</h2>
    </div>
    @endif
</div>
@endsection
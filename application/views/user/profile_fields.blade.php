@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
$has_domain_types = array(
    \CALOS\Entities\MetaEntity::TYPE_SELECT_MULTI,
    \CALOS\Entities\MetaEntity::TYPE_SELECT_SINGLE
);

?>
@section('page-content')
<div id='profile' class='page container'>
    <div class='row'>
	<h2>{{__('user.current custom profile field label')}}</h2>
    </div>
    <div class='row'>
	<div class='ten columns' id='content'>
	    <form method="post" action="{{ URL::current() }}">
		<section id='current_fields'>
		    @foreach($current_fields as $field)
		    <div class='row template-field template-{{$field->type}} '>
			<div class='fourteen columns'>
			    <h4 class='header'>
				<span class='pull_left'>
				    <span class="close">
					<i class='icon-down-open-big'></i>
				    </span>


				    <span class="title">{{$field->title}}</span>
				</span>
				<span class='pull_right'>
				    <a title="{{__('user.remove custom field label')}}" class="remove">
					<i class="icon-cancel-circled"></i>
				    </a>
				</span>
				<span class='clearfix'></span>
			    </h4>
			    <div class='content'>
				<input type='hidden' name='fields[item_{{$field->get_id()}}][type]'  class='custom type'  value='{{$field->type}}' />
				<input type='hidden' name='fields[item_{{$field->get_id()}}][id]'  class='custom type'  value='{{$field->get_id()}}' />
				<p>
				    <span>{{__('user.custom field type label')}}</span>: <b>{{__('user.custom field '.$field->type.' label')}}</b>
				</p>
				<p class='field'>
				    {{Form::label('fields[item_'.$field->get_id().'][title]', __('user.custom field title label'))}}
				    {{Form::text('fields[item_'.$field->get_id().'][title]', $field->title, array('class'=>'input text custom title'))}}
				</p>
				<p class='field'>
				    {{Form::label('fields[item_'.$field->get_id().'][description]', __('user.custom field description label'))}}
				    {{Form::text('fields[item_'.$field->get_id().'][description]', $field->description, array('class'=>'input text custom description'))}}
				</p>
				@if(in_array($field->type,$has_domain_types))
				<p class='field'>
				    {{Form::label('fields[item_'.$field->get_id().'][domain]', __('user.custom field domain label'))}}
				    {{Form::textarea('fields[item_'.$field->get_id().'][domain]', implode("\n", unserialize($field->domain) ), array('class'=>'input textarea custom domain'))}}
				</p>
				@endif
			    </div>
			</div>
		    </div>
		    @endforeach
		</section>
		<div class='valign'>
		    <div class="large primary btn icon-left entypo icon-check pull_left" >
			<input type='submit' name='update_fields'  value='{{__('user.update profile fields label')}}'/>

		    </div>
		    <div class='medium info btn icon-left entypo icon-plus pull_right'>
			<a href='#add_custom_field'>{{__('user.add custom field label')}}</a>
		    </div>
		    <div class='clearfix'></div>
		</div>

	    </form>
	    <section class='hide' id='field_templates'>
		<div class='row template-field template-{{ \CALOS\Entities\MetaEntity::TYPE_TEXT}} '>
		    <div class='fourteen columns'>
			<h4 class='header'>
			    <span class='pull_left'>
				<span class="close">
				    <i class='icon-up-open-big show'></i>
				</span>


				<span class="title"></span>
			    </span>
			    <span class='pull_right'>
				<a title="{{__('user.remove custom field label')}}" class="remove">
				    <i class="icon-cancel-circled"></i>
				</a>
			    </span>
			    <span class='clearfix'></span>
			</h4>
			<div class='content'>
			    <input type='hidden'  class='custom type'  value='{{ \CALOS\Entities\MetaEntity::TYPE_TEXT}}' />
			    <p>
				<span>{{__('user.custom field type label')}}</span>: <b>{{__('user.custom field '.\CALOS\Entities\MetaEntity::TYPE_TEXT.' label')}}</b>
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field title label'))}}
				{{Form::text('', '', array('class'=>'input text custom title'))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field description label'))}}
				{{Form::text('', '', array('class'=>'input text custom description'))}}
			    </p>
			</div>
		    </div>
		</div>
		<div class='row template-field template-{{ \CALOS\Entities\MetaEntity::TYPE_TEXTAREA}} '>
		    <div class='fourteen columns'>
			<h4 class='header'>
			    <span class='pull_left'>
				<span class="close">
				    <i class='icon-up-open-big show'></i>
				</span>


				<span class="title"></span>
			    </span>
			    <span class='pull_right'>
				<a title="{{__('user.remove custom field label')}}" class="remove">
				    <i class="icon-cancel-circled"></i>
				</a>
			    </span>
			    <span class='clearfix'></span>
			</h4>
			<div class='content'>
			    <input type='hidden'  class='custom type'  value='{{ \CALOS\Entities\MetaEntity::TYPE_TEXTAREA}}' />
			    <p>
				<span>{{__('user.custom field type label')}}</span>: <b>{{__('user.custom field '.\CALOS\Entities\MetaEntity::TYPE_TEXTAREA.' label')}}</b>
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field title label'))}}
				{{Form::text('', '', array('class'=>'input text custom title'))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field description label'))}}
				{{Form::text('', '', array('class'=>'input text custom description'))}}
			    </p>
			</div>
		    </div>
		</div>
		<div class='row template-field template-{{ \CALOS\Entities\MetaEntity::TYPE_SELECT_SINGLE}} '>
		    <div class='fourteen columns'>
			<h4 class='header'>
			    <span class='pull_left'>
				<span class="close">
				    <i class='icon-up-open-big show'></i>
				</span>


				<span class="title"></span>
			    </span>
			    <span class='pull_right'>
				<a title="{{__('user.remove custom field label')}}" class="remove">
				    <i class="icon-cancel-circled"></i>
				</a>
			    </span>
			    <span class='clearfix'></span>
			</h4>
			<div class='content'>
			    <input type='hidden'  class='custom type'  value='{{ \CALOS\Entities\MetaEntity::TYPE_SELECT_SINGLE}}' />
			    <p>
				<span>{{__('user.custom field type label')}}</span>: <b>{{__('user.custom field '.\CALOS\Entities\MetaEntity::TYPE_SELECT_SINGLE.' label')}}</b>
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field title label'))}}
				{{Form::text('', '', array('class'=>'input text custom title'))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field description label'))}}
				{{Form::text('', '', array('class'=>'input text custom description'))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field domain label'))}}
				{{Form::textarea('', '', array('class'=>'input textarea custom domain'))}}
			    </p>
			</div>
		    </div>
		</div>
		<div class='row template-field template-{{ \CALOS\Entities\MetaEntity::TYPE_SELECT_MULTI}} '>
		    <div class='fourteen columns'>
			<h4 class='header'>
			    <span class='pull_left'>
				<span class="close">
				    <i class='icon-up-open-big show'></i>
				</span>


				<span class="title"></span>
			    </span>
			    <span class='pull_right'>
				<a title="{{__('user.remove custom field label')}}" class="remove">
				    <i class="icon-cancel-circled"></i>
				</a>
			    </span>
			    <span class='clearfix'></span>
			</h4>
			<div class='content'>
			    <input type='hidden' class='custom type'  value='{{ \CALOS\Entities\MetaEntity::TYPE_SELECT_MULTI}}' />
			    <p>
				<span>{{__('user.custom field type label')}}</span>: <b>{{__('user.custom field '.\CALOS\Entities\MetaEntity::TYPE_SELECT_MULTI.' label')}}</b>
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field title label'))}}
				{{Form::text('', '', array('class'=>'input text custom title'))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field description label'))}}
				{{Form::text('', '', array('class'=>'input text custom description'))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field domain label'))}}
				{{Form::textarea('', '', array('class'=>'input textarea custom domain'))}}
			    </p>
			</div>
		    </div>
		</div>
	    </section>
	</div>
	<div class='four columns' id='add_custom_field'>
	    <h3>{{__('user.add new custom profile field')}}</h3>
	    <div class='row'>
		<p class='medium info btn icon-right icon-plus'>
		    <a data-type='{{ \CALOS\Entities\MetaEntity::TYPE_TEXT}}'>{{__('user.add new profile text field')}}</a>
		</p>
	    </div>
	    <div class='row'>
		<p class='medium info btn icon-right icon-plus'>
		    <a data-type='{{\CALOS\Entities\MetaEntity::TYPE_TEXTAREA}}'>{{__('user.add new profile textarea field')}}</a>
		</p>
	    </div>
	    <div class='row'>
		<p class='medium info btn icon-right icon-plus'>
		    <a data-type='{{\CALOS\Entities\MetaEntity::TYPE_SELECT_SINGLE}}'>{{__('user.add new profile select single field')}}</a>
		</p>
	    </div>
	    <div class='row'>
		<p class='medium info btn icon-right icon-plus'>
		    <a data-type='{{\CALOS\Entities\MetaEntity::TYPE_SELECT_MULTI}}'>{{__('user.add new profile select multy field')}}</a>
		</p>
	    </div>
	</div>
    </div>
</div>
@endsection

@section('message')
<div class='gumby_message' id='remove_item_message'>
    <div class='row'>
	<h2>{{__('user.remove custom field confirmation message title')}}</h2>
	<div>
	    <p>
		{{__('user.remove custom field confirmation message body')}}
	    </p>
	</div>
    </div>
    <div class='row'>
	<div class='pull_right'>
	    <div class='medium info btn icon-left icon-check button_confirm'>
		<a>{{__('user.remove custom field confirm button')}}</a>
	    </div>
	    <div class='medium primary btn icon-left icon-check button_cancel'>
		<a>{{__('user.remove custom field cancel button')}}</a>
	    </div>
	</div>
	<div class='clearfix'></div>
    </div>
</div>
@endsection
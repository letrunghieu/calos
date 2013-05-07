@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
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
			<div class='header'>
			    <span class='pull_left title'>Field name</span>
			    <span class='pull_right close'>
				<a class='show'><i class='icon-minus'></i></a>
			    </span>
			    <span class='clearfix'></span>
			</div>
			<div class='content'>
			    <input type='hidden'  class='custom type'  value='{{ \CALOS\Entities\MetaEntity::TYPE_TEXT}}' />
			    <p>
				<span>{{__('user.custom field type label')}}</span>:<b>{{__('user.custom field '.\CALOS\Entities\MetaEntity::TYPE_TEXT.' label')}}</b>
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field title label'))}}
				{{Form::text('', '', array('class'=>'input text custom title', 'id' => null))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field description label'))}}
				{{Form::text('', '', array('class'=>'input text custom description', 'id' => null))}}
			    </p>
			    <div class='pull_right'>
				<div class='medium warning btn icon-left icon-trash'>
				    <a>{{__('user.remove custom field label')}}</a>
				</div>
			    </div>
			    <div class='clearfix'></div>
			</div>
		    </div>
		</div>
		<div class='row template-field template-{{ \CALOS\Entities\MetaEntity::TYPE_TEXTAREA}} '>
		    <div class='fourteen columns'>
			<div class='header'>
			    <span class='pull_left title'>Field name</span>
			    <span class='pull_right close'>
				<a class='show'><i class='icon-minus'></i></a>
			    </span>
			    <span class='clearfix'></span>
			</div>
			<div class='content'>
			    <input type='hidden'  class='custom type'  value='{{ \CALOS\Entities\MetaEntity::TYPE_TEXTAREA}}' />
			    <p>
				<span>{{__('user.custom field type label')}}</span>:<b>{{__('user.custom field '.\CALOS\Entities\MetaEntity::TYPE_TEXTAREA.' label')}}</b>
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field title label'))}}
				{{Form::text('', '', array('class'=>'input text custom title', 'id' => null))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field description label'))}}
				{{Form::text('', '', array('class'=>'input text custom description', 'id' => null))}}
			    </p>
			    <div class='pull_right'>
				<div class='medium warning btn icon-left icon-trash'>
				    <a>{{__('user.remove custom field label')}}</a>
				</div>
			    </div>
			    <div class='clearfix'></div>
			</div>
		    </div>
		</div>
		<div class='row template-field template-{{ \CALOS\Entities\MetaEntity::TYPE_SELECT_SINGLE}} '>
		    <div class='fourteen columns'>
			<div class='header'>
			    <span class='pull_left title'>Field name</span>
			    <span class='pull_right close'>
				<a class='show'><i class='icon-minus'></i></a>
			    </span>
			    <span class='clearfix'></span>
			</div>
			<div class='content'>
			    <input type='hidden'  class='custom type'  value='{{ \CALOS\Entities\MetaEntity::TYPE_SELECT_SINGLE}}' />
			    <p>
				<span>{{__('user.custom field type label')}}</span>:<b>{{__('user.custom field '.\CALOS\Entities\MetaEntity::TYPE_SELECT_SINGLE.' label')}}</b>
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field title label'))}}
				{{Form::text('', '', array('class'=>'input text custom title', 'id' => null))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field description label'))}}
				{{Form::text('', '', array('class'=>'input text custom description', 'id' => null))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field domain label'))}}
				{{Form::textarea('', '', array('class'=>'input textarea custom domain', 'id' => null))}}
			    </p>
			    <div class='pull_right'>
				<div class='medium warning btn icon-left icon-trash'>
				    <a>{{__('user.remove custom field label')}}</a>
				</div>
			    </div>
			    <div class='clearfix'></div>
			</div>
		    </div>
		</div>
		<div class='row template-field template-{{ \CALOS\Entities\MetaEntity::TYPE_SELECT_MULTI}} '>
		    <div class='fourteen columns'>
			<div class='header'>
			    <span class='pull_left title'>Field name</span>
			    <span class='pull_right close'>
				<a class='show'><i class='icon-minus'></i></a>
			    </span>
			    <span class='clearfix'></span>
			</div>
			<div class='content'>
			    <input type='hidden' class='custom type'  value='{{ \CALOS\Entities\MetaEntity::TYPE_SELECT_MULTI}}' />
			    <p>
				<span>{{__('user.custom field type label')}}</span>:<b>{{__('user.custom field '.\CALOS\Entities\MetaEntity::TYPE_SELECT_MULTI.' label')}}</b>
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field title label'))}}
				{{Form::text('', '', array('class'=>'input text custom title', 'id' => null))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field description label'))}}
				{{Form::text('', '', array('class'=>'input text custom description', 'id' => null))}}
			    </p>
			    <p class='field'>
				{{Form::label('', __('user.custom field domain label'))}}
				{{Form::textarea('', '', array('class'=>'input textarea custom domain', 'id' => null))}}
			    </p>
			    <div class='pull_right'>
				<div class='medium warning btn icon-left icon-trash'>
				    <a>{{__('user.remove custom field label')}}</a>
				</div>
			    </div>
			    <div class='clearfix'></div>
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
@layout('layout.inner')

@section('page-content')
<div class='page container' id='view_unit'>
    <div class='row'>

    </div>
    <div class='row'>
	<div class='span9'>
	    <h2>{{$org_unit->name }}<br />
		<small>{{ __('organization.belongs to %s', array('name' => $parent->name, 'link' => URL::to_action('organization@view_unit', array($parent->id)))) }}</small>
	    </h2>
	    <div>
		<?php echo $org_unit->description ?>
	    </div>
	    <div>
		<?php echo render('shared._org_unit_detail', array('org_unit' => $org_unit, 'vacancies' => $vacancies, 'children' => $children)) ?>
	    </div>
	</div>
	<div class='span3'>
	    <div class='sidebar'>
		<ul class='nav nav-tabs nav-stacked'>
		    <li class='field'>
			    <a href='{{URL::to_action("organization@unit_members", array($org_unit->id))}}'>{{__('organization.unit members')}}</a>
		    </li>
		    <li class='field'>
			    <a href='{{URL::to_action("organization@edit_unit", array($org_unit->id))}}'>{{__('organization.edit unit')}}</a>
		    </li>
		    <li class='field'>
			    <a href='{{URL::to_action("organization@remove_unit", array($org_unit->id))}}'>{{__('organization.remove unit')}}</a>
		    </li>
		</ul>
	    </div>
	</div>
    </div>
</div>
@endsection
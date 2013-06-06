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
		@render('shared._org_unit_sidebar', array('org_unit' => $org_unit))
	    </div>
	</div>
    </div>
</div>
@endsection
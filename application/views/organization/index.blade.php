@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id="view_org_structure" class="page container">
    <div class='row'>
	<div class='span9'>
	    <h2>{{ $org_unit->name }}</h2>
	    <div class='org_unit_detail'>
		<?php echo $org_unit->description ?>
	    </div>
	    <div>
		<?php echo render('shared._org_unit_detail', array('org_unit' => $org_unit, 'vacancies' => $vacancies, 'children' => $children)) ?>
	    </div>

	</div>
	<div class='span3'>
	    <div class='sidebar'>
		<ul class='nav nav-tabs nav-stacked'>
		    <li class="field">
			<a href='{{URL::to_action("organization@unit_members", array($org_unit->id))}}'>{{__('organization.unit members')}}</a>
		    </li>
		    <li class='field'>
			<a href='{{URL::to_action("organization@edit_unit", array($org_unit->id))}}'>{{__('organization.edit unit')}}</a>
		    </li>
		</ul>
	    </div>
	</div>
    </div>
</div>
@endsection
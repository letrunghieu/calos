@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id="view_org_structure" class="page container">
    <div class="row">

    </div>
    <div class='row'>
	<div class='ten columns'>
	    <h2>{{ $org_unit->name }}</h2>
	    <div class='org_unit_detail'>
		<?php echo $org_unit->description ?>
	    </div>
	    <div>
		<?php echo render('shared._org_unit_detail', array('org_unit' => $org_unit, 'vacancies' => $vacancies, 'children' => $children)) ?>
	    </div>

	</div>
	<div class='four columns'>
	    <div class='sidebar'>
		<ul class='nopad'>
		    <li class="field">
			<div class='medium default btn fourteen columns'>
			    <a href='{{URL::to_action("organization@unit_members", array($org_unit->id))}}'>{{__('organization.unit members')}}</a>
			</div>
		    </li>
		    <li class='field'>
			<div class='medium default btn fourteen columns'>
			    <a href='{{URL::to_action("organization@edit_unit", array($org_unit->id))}}'>{{__('organization.edit unit')}}</a>
			</div>
		    </li>
		</ul>
	    </div>
	</div>
    </div>
</div>
@endsection
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
		@render('shared._org_unit_sidebar', array('org_unit' => $org_unit))
	    </div>
	</div>
    </div>
</div>
@endsection
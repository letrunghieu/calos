@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id="view_org_structure" class="page container">
    <div class="row">
	<h2>{{__('organization.view our organization structure')}}</h2>
    </div>
    <div class='row'>
	<div class='ten columns'>
	    <div id='canvas_container'>
		
	    </div>
	</div>
	<div class='four columns'>
	    <ul class='nopad'>
		<li class='field'>
		    <div class='medium primary btn fourteen columns'>
			<a href='{{URL::to_action("organization@view_unit", array(1))}}'>View vacancy details</a>
		    </div>
		</li>
		<li class='field'>
		    <div class='medium info btn fourteen columns'>
			<a href='{{URL::to_action("organization@edit_unit", array(1))}}'>Edit this vacancy</a>
		    </div>
		</li>
		<li class='field'>
		    <div class='medium danger btn fourteen columns'>
			<a href=''>Remove this vacancy</a>
		    </div>
		</li>
	    </ul>
	</div>
    </div>
</div>
@endsection
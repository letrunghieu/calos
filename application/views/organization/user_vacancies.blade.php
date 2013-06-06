@layout('layout.inner')

@section('page-content')
<div id="view_org_structure" class="page container">
    <div class='row'>
	<div class='span9'>
	    <h2>{{__('organization.list vacancies of %', array('name' => $user->display_name))}}</h2>
	    <div>
		<table class="table table-bordered table-striped">
		    <thead>
			<tr>
			    <th>#</th>
			    <th>{{__('organization.name')}}</th>
			    <th>{{__('organization.vacancy name')}}</th>
			</tr>
		    </thead>
		    <tbody>
			<?php $i = 0; ?>
			@foreach($vacancies as $v)
			<tr>
			    <td>
				{{++$i}}
			    </td>
			    <td>
				{{HTML::link(URL::to_action('organization@view_unit', array($v->unit->id)), $v->unit->name)}}
			    </td>
			    <td>
				{{$v->name}}
			    </td>
			</tr>
			@endforeach
		    </tbody>
		</table>
	    </div>
	</div>
	<div class='span3'>
	    <div class='sidebar'>
		<?php echo render('shared._user_sidebar', array('user'=>$user)) ?>
	    </div>
	</div>
    </div>
</div>
@endsection
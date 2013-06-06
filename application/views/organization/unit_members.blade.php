@layout('layout.inner')

@section('page-content')
<div class='page container' id='view_unit'>
    <div class='row'>

    </div>
    <div class='row'>
	<div class='span9'>
	    <h2>{{$org_unit->name }}<br />
		<small>{{ $parent ? __('organization.belongs to %s', array('name' => $parent->name, 'link' => URL::to_action('organization@view_unit', array($parent->id)))) : ""}}</small>
	    </h2>
	    <div>
		<p>
		    {{ __('organization.list of %s members', array('total' => $paginate_total))}}
		</p>
		
		<table class="table table-bordered table-striped">
		    <thead>
			<tr>
			    <th>#</th>
			    <th>
				
				{{ __('user.display name label')}}
			    </th>
			    <th>
				<?php
				$q = array_merge($querystrings, array(
				    'sort' => 'first_name',
				    'order' => (Input::get('order') == 'asc' && Input::get('sort') == 'first_name' ? 'desc' : 'asc')
				));

				echo HTML::link(URL::current() . (count($q) ? "?" . http_build_query($q) : ""), __('user.first name label'))
				?>
			    </th>
			    <th>
				<?php
				$q = array_merge($querystrings, array(
				    'sort' => 'email',
				    'order' => (Input::get('order') == 'asc' && Input::get('sort') == 'email' ? 'desc' : 'asc')
				));

				echo HTML::link(URL::current() . (count($q) ? "?" . http_build_query($q) : ""), __('user.email label'))
				?>
			    </th>
			    <th>
				{{__('user.mobile phone label')}}
			    </th>
			</tr>
		    </thead>
		    <tbody>
			<?php $i = $paginate_start;?>
			@foreach($members as $mem)
			<tr>
			    <th>{{++$i}}</th>
			    <td>
				{{ Gravitas\API::image($mem->email, 30, $mem->display_name, array('class' => 'img-circle'))}} {{HTML::link(URL::to_action('user@view_profile', array($mem->id)),$mem->display_name)}}
			    </td>
			    <td>{{$mem->first_name}}</td>
			    <td>{{$mem->email}}</td>
			    <td>{{$mem->mobile_phone}}</td>
			</tr>
			@endforeach
		    </tbody>
		</table>
		<div>
		    {{$paginate_link}}
		</div>
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
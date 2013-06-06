@layout('layout.inner')
<?php
$unit_id = Input::get('unit');
?>
@section('page-content')
<div class='page container' id='view_unit'>
    <div class='row'>

    </div>
    <div class='row'>
	<div class='span9'>
	    <h2>{{ __('activity.list activities of %s', array('name' => $user->display_name)) }}<br />
	    </h2>
	    <div>

		<div>
		    <p>
			{{ __('organization.list of %s activities', array('total' => $paginate_total, 'from' => $paginate_start + 1, 'to' => $paginate_start + count($activities)))}}
		    </p>
		</div>



		<div>
		    <div class='text-right'>
			<div class="btn-group  text-left">
			    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				{{__('activity.as ' . $role)}}
				<span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
				@foreach($avail_roles as $av)
				<li>
				    <?php
				    $q = array_merge($querystrings, array('role' => $av));
				    ?>
				    {{HTML::link(URL::current() . '?' . http_build_query($q),__('activity.as ' . $av))}}
				</li>
				@endforeach

			    </ul>
			</div>
			<div class="btn-group  text-left">
			    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				{{__('activity.sort by ' . $sort)}}
				<span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
				@foreach($avail_sorts as $av)
				<li>
				    <?php
				    $q = array_merge($querystrings, array('sort' => $av));
				    ?>
				    {{HTML::link(URL::current() . '?' . http_build_query($q),__('activity.sort by ' . $av))}}
				</li>
				@endforeach

			    </ul>
			</div>
			<div class="btn-group  text-left">
			    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				{{__('common.' . $order)}}
				<span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
				@foreach($avail_orders as $av)
				<li>
				    <?php
				    $q = array_merge($querystrings, array('order' => $av));
				    ?>
				    {{HTML::link(URL::current() . '?' . http_build_query($q),__('common.' . $av))}}
				</li>
				@endforeach
			    </ul>
			</div>
			<div class="btn-group  text-left">
			    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				{{__('activity.view ' . $filter .' status')}}
				<span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
				@foreach($avail_filters as $av)
				<li>
				    <?php
				    $q = array_merge($querystrings, array('filter' => $av));
				    ?>
				    {{HTML::link(URL::current() . '?' . http_build_query($q),__('activity.view ' . $av .' status'))}}
				</li>
				@endforeach
			    </ul>
			</div>
		    </div>
		    <p>
			&nbsp;
		    </p>
		</div>

		<div>
		    <?php echo render('shared._activity_list', array('activities' => $activities)) ?>
		</div>
	    </div>
	    <div>
		{{$paginate_link}}
	    </div>
	</div>
	<div class='span3'>
	    <div class='sidebar'>
		<?php 
		    echo render('shared._user_sidebar', array('user'=> $user));
		?><p>
		    &nbsp;
		</p>
		<ul class='nav nav-list'>
		    <li class="nav-header">{{__('activity.view by unit')}}</li>
		    <?php
		    $q = array_merge($querystrings, array('unit' => 0));
		    ?>
		    <li class='{{$unit == 0 ? "active" : ""}}'>
			<a href='{{URL::current() . '?' . http_build_query($q)}}'>{{__('organization.all unit')}}</a>
		    </li>
		    @foreach($vacancies as $v)
		    <?php
		    $q = array_merge($querystrings, array('unit' => $v->unit->id));
		    ?>
		    <li class='{{$v->unit->id == $unit ? "active" : ""}}'>
			<a href='{{URL::current() . '?' . http_build_query($q)}}'>{{$v->unit->name}}</a>
		    </li>
		    @endforeach

		</ul>
		
		
	    </div>
	</div>
    </div>

</div>
@endsection
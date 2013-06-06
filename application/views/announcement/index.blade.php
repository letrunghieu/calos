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
	    <h2>{{ __('announcement.list announcements') }}<br />
	    </h2>
	    <div>

		<div class='row-fluid'>
		    <p class='span3'>
			{{ __('announcement.list of %s', array('total' => $paginate_total, 'from' => $paginate_start + 1, 'to' => $paginate_start + count($announcements)))}}
		    </p>
		    <div class='span9 text-right'>
			<div class="btn-group  text-left">
			    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				{{__('announcement.as ' . $role)}}
				<span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
				@foreach($avail_roles as $av)
				<li>
				    <?php
				    $q = array_merge($querystrings, array('role' => $av));
				    ?>
				    {{HTML::link(URL::current() . '?' . http_build_query($q),__('announcement.as ' . $av))}}
				</li>
				@endforeach

			    </ul>
			</div>
			<div class="btn-group  text-left">
			    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				{{__('common.time ' . $order)}}
				<span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
				@foreach($avail_orders as $av)
				<li>
				    <?php
				    $q = array_merge($querystrings, array('order' => $av));
				    ?>
				    {{HTML::link(URL::current() . '?' . http_build_query($q),__('common.time ' . $av))}}
				</li>
				@endforeach
			    </ul>
			</div>
			<div class="btn-group  text-left">
			    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				{{__('announcement.view ' . $filter .' status')}}
				<span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
				@foreach($avail_filters as $av)
				<li>
				    <?php
				    $q = array_merge($querystrings, array('filter' => $av));
				    ?>
				    {{HTML::link(URL::current() . '?' . http_build_query($q),__('announcement.view ' . $av .' status'))}}
				</li>
				@endforeach
			    </ul>
			</div>
		    </div>
		</div>



		<div>
		    
		    <p>
			&nbsp;
		    </p>
		</div>

		<div>
		    <?php echo render('shared._list_announcements', compact('announcements')) ?>
		</div>
	    </div>
	    <div>
		{{$paginate_link}}
	    </div>
	</div>
	<div class='span3'>
	    <div class='sidebar'>
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
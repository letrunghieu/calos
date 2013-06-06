@layout('layout.inner')
<?php
?>
@section('page-content')
<div class='page container' id='view_unit'>
    <div class='row'>

    </div>
    <div class='row'>
	<div class='span9'>
	    <h2>{{ __('announcement.list announcements') }}<br />
		<small>{{$org_unit->name}}</small>
	    </h2>
	    <div>

		<div class='row-fluid'>
		    <p class='span3'>
			{{ __('announcement.list of %s', array('total' => $paginate_total, 'from' => $paginate_start + 1, 'to' => $paginate_start + count($announcements)))}}
		    </p>
		    <div class='span9 text-right'>
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
		@render('shared._org_unit_sidebar', array('org_unit' => $org_unit))		
	    </div>
	</div>
    </div>

</div>
@endsection
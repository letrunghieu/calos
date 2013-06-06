@layout('layout.inner')
<?php $today = new DateTime(); ?>
@section('page-content')
<div class='page container' id='view_unit'>
    <div class='row'>

    </div>
    <div class='row'>
	<div class='span9'>
	    <h2>{{ __('activity.activity list') }}<br />
		<small>{{ $org_unit->name }}</small>
	    </h2>
	    <div>

		<div class='row'>
		    <div class='span2'>
			<p>
			    {{ __('organization.list of %s activities', array('total' => $paginate_total, 'from' => $paginate_start + 1, 'to' => $paginate_start + count($activities)))}}
			</p>
		    </div>
		    <div class='span7 text-right'>
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
		    <div id='activities_container'>
			@foreach($activities as $act)
			<div class='activity preview'>
			    <div class='row-fluid'>
				<div class='span10'>

				    <h4><i class='icon-bookmark'></i> {{ HTML::link(URL::to_action('activity@view', array($act->id)), $act->title) }}</h4>
				</div>
				<div class='span2 text-right'>
				    {{__('activity.status '. $act->status_label())}}
				</div>
			    </div>
			    <div class='row-fluid'>
				<div class='span8'>
				    {{Gravitas\API::image($act->creator->email, 24, '', array('class'=>'img-circle'))}} {{ HTML::link(URL::to_action('user@view_profile', array($act->creator->id)), $act->creator->display_name) }}
				    <small>{{ __('activity.created on %s', array('time' => $act->created_at->format('Y-m-d H:i:s')))}}</small>
				</div>
				<div class='span4'>
				    <small>
					<i class='icon-calendar'></i> 
					{{__('activity.deadline')}}: {{$act->deadline->format('Y-m-d H:i')}}
					<small>
					    <?php echo sprintf('(%+d %s)', CALOS\Services\ConvertService::date_diff($today, $act->deadline), __('common.days')) ?>
					</small>
				    </small>
				</div>
			    </div>
			    <div class='row-fluid'>
				<div class='span8'>
				    @if($act->assignee)
				    {{Gravitas\API::image($act->assignee->email, 24, '', array('class'=>'img-circle'))}} {{ HTML::link(URL::to_action('user@view_profile', array($act->assignee->id)), $act->assignee->display_name) }}
				    <small>{{ __('activity.assigned on %s', array('time' => $act->assigning_time->format('Y-m-d H:i:s')))}}</small>
				    @endif
				</div>
				<div class='span4'>
				    <span><small>{{__('activity.progress %d', array('value' => $act->progress))}}</small></span>
				    <div class="progress progress-{{$act->status_progress_label()}}">
					<div class="bar" style="width: {{$act->progress}}%;"></div>
				    </div>
				</div>
			    </div>
			</div>
			@endforeach
		    </div>
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
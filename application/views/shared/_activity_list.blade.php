<?php $today = new DateTime(); ?>
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
	<div class='text-right'>
	    <small>{{HTML::link(URL::to_action('organization@view_unit', array($act->org_unit->id)), $act->org_unit->name)}}</small>
	</div>
    </div>
    @endforeach
</div>
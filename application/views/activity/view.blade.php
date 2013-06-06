@layout('layout.inner')
<?php
$today = new DateTime;
$range = array();
foreach (range(0, 100, 10) as $v)
{
    $range[$v] = $v . "%";
}
?>
@section('page-content')
<div id="view_org_structure" class="page container">
    <div class='row'>
	<div class='span9 activity'>
	    <h2>{{ $activity->title }}<br />
		<small>{{$activity->org_unit->name}}</small>
	    </h2>
	    <div>
		<h3>{{__('activity.summary')}}</h3>
		<div class='row-fluid activity_summary'>
		    <div class='span6 personel'>
			<div>
			    {{Gravitas\API::image($activity->creator->email, 32, '', array('class'=>'img-circle'))}} {{ HTML::link(URL::to_action('user@view_profile', array($activity->creator->id)), $activity->creator->display_name) }}<br />
			    <small>{{ __('activity.created on %s', array('time' => $activity->created_at->format('Y-m-d H:i:s')))}}</small>
			</div>
			@if($activity->assignee)
			<div>
			    {{Gravitas\API::image($activity->assignee->email, 32, '', array('class'=>'img-circle'))}} {{ HTML::link(URL::to_action('user@view_profile', array($activity->assignee->id)), $activity->assignee->display_name) }}<br />
			    <small>{{ __('activity.assigned on %s', array('time' => $activity->assigning_time->format('Y-m-d H:i:s')))}}</small>
			</div>
			@endif
		    </div>
		    <div class='span6 text-right'>
			<div>
			    <i class='icon-calendar'></i> 
			    {{__('activity.deadline')}}: {{$activity->deadline->format('Y-m-d H:i')}}
			    <small>
				<?php echo sprintf('(%+d %s)', CALOS\Services\ConvertService::date_diff($today, $activity->deadline), __('common.days')) ?>
			    </small>
			</div>
			<div>
			    <span><small>{{__('activity.progress %d', array('value' => $activity->progress))}}</small></span>
			    <div class="progress progress-{{$activity->status_progress_label()}}">
				<div class="bar" style="width: {{$activity->progress}}%;"></div>
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	    <div class='activity_descr'>
		<h3>{{__('activity.description')}}</h3>
		<div>
		    {{$activity->description}}
		</div>
	    </div>
	    <?php if($activity->assignee->id == $user->id && $activity->status() != CALOS\Entities\ActivityEntity::STATUS_COMPLETED): ?>
	    <div class='activity_progress'>
		<?php echo Form::open(URL::current()) ?>
		<legend>
		    {{__('activity.progress update')}}
		</legend>
		<p>
		    <?php echo Form::label('progress', __('activity.update this activity progress')) ?>
		    <?php echo Form::select('progress', $range, (int) (round($activity->progress / 10)) * 10); ?>
		</p>
		<p>
		    <?php echo Form::submit(__('common.update'), array('name' => 'update_progress', 'class' => 'btn btn-primary')) ?>
		</p>
		<?php echo Form::close(); ?>
	    </div>
	    <?php endif; ?>
	    <?php if ($activity->creator->id == $user->id && $activity->status() != CALOS\Entities\ActivityEntity::STATUS_COMPLETED): ?>
    	    <div class='activity_mark_complete'>
		    <?php echo Form::open(URL::current()) ?>
    		<legend>
    		    {{__('activity.mark complete')}}
    		</legend>
    		<div>
			<?php echo Form::label('comment', __('activity.confirm that activity complete', array('name' => $activity->assignee->display_name))) ?>
			<?php echo Form::textarea('comment', '', array('id' => 'assigner_comment')) ?>
    		</div>
    		<p>
    		    <br />
			<?php echo Form::submit(__('common.confirm'), array('name' => 'update_complete', 'class' => 'btn btn-primary')) ?>
    		</p>
		    <?php echo Form::close(); ?>
    	    </div>
	    <?php endif; ?>
	    
	    <?php if ( $activity->status() == CALOS\Entities\ActivityEntity::STATUS_COMPLETED): ?>
    	    <div class='activity_complete'>
		<fieldset>
		    <legend>{{__('activity.completed')}}</legend>
		    <p>
		    {{Gravitas\API::image($activity->creator->email, 24, '', array('class'=>'img-circle'))}} {{ HTML::link(URL::to_action('user@view_profile', array($activity->creator->id)), $activity->creator->display_name) }} 
			    {{ __('activity.marked completed on %s with message', array('time' => $activity->completed_time->format('Y-m-d H:i:s')))}}
		</p>
		    <blockquote class='message'>
			{{$activity->creator_comment}}
		    </blockquote>
		</fieldset>
		
    	    </div>
	    <?php endif; ?>
	</div>
	<div class='span3'>
	    <div class='sidebar'>
		<?php echo render('shared._activity_sidebar', array('activity' => $activity, 'user' => $user)) ?>
	    </div>
	</div>
    </div>
</div>
@endsection

@section('foot_scripts')

<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
	selector: "textarea",
	height: 160,
	plugins: [
	    "advlist autolink lists link image charmap print preview anchor",
	    "searchreplace visualblocks code fullscreen",
	    "insertdatetime media table contextmenu paste"
	],
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
</script>
@endsection
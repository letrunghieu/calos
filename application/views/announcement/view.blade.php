@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id="view_org_structure" class="page container">
    <div class='row'>
	<div class='span9'>
	    <h2>{{ $announcement->title}}</h2>
	    <div>
		<?php echo __('announcement.posted by %s on %s in %s', array(
		    'creator' => Gravitas\API::image($announcement->creator->email, 24, '', array('class' => 'img-circle')) . " " . HTML::link(URL::to_action('user@view_profile', array($announcement->creator->id)), $announcement->creator->display_name),
		    'time' => $announcement->created_at->format('H:i:s \n\gà\y d \t\há\n\g m \nă\m Y'),
		    'org' => HTML::link(URL::to_action('organization@view_unit', array($announcement->org_unit->id)), $announcement->org_unit->name),
		))  ?>
	    </div>
	    <div class='org_unit_detail'>
		<fieldset>
		    <legend>{{__('announcement.content')}}</legend>
		    <div>
			<?php echo $announcement->content ?>
		    </div>
		</fieldset>
	    </div>
	    <?php if(($date = \CALOS\Repositories\AnnouncementRepository::user_read_time($user->id, $announcement->id))): ?>
	    <fieldset>
		    <legend>{{__('announcement.confirm read')}}</legend>
		    <div>
			{{__('announcement.read on %s', array('time'=>$date->format('Y-m-d H:i:s')))}}
		    </div>
		</fieldset>
	    <?php else: ?>
	    <?php echo Form::open(URL::current()) ?>
	    <fieldset>
		    <legend>{{__('announcement.confirm read')}}</legend>
		    <div>
			<?php echo Form::hidden('announcement_id', $announcement->id) ?>
			<?php echo Form::submit(__('common.confirm'), array('class' => 'btn btn-primary', 'name' => 'commit')) ?>
		    </div>
		</fieldset>
	    <?php echo Form::close();?>
	    <?php endif; ?>

	</div>
	<div class='span3'>
	    <div class='sidebar'>
		<?php echo render('shared._announcement_sidebar', compact('announcement')) ?>
	    </div>
	</div>
    </div>
</div>
@endsection
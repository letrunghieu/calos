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
		<?php
		echo __('announcement.posted by %s on %s in %s', array(
		    'creator' => Gravitas\API::image($announcement->creator->email, 24, '', array('class' => 'img-circle')) . " " . HTML::link(URL::to_action('user@view_profile', array($announcement->creator->id)), $announcement->creator->display_name),
		    'time' => $announcement->created_at->format('H:i:s \n\gà\y d \t\há\n\g m \nă\m Y'),
		    'org' => HTML::link(URL::to_action('organization@view_unit', array($announcement->org_unit->id)), $announcement->org_unit->name),
		))
		?>
	    </div>
	    <div class='org_unit_detail'>
		<fieldset>
		    <legend>{{__('announcement.view announcement unread')}} ({{$paginate_total}})</legend>
		    <div>
			{{$paginate_link}}
		    </div>
		    <div>
			<table class='table table-bordered table-condensed'>
			    <thead>
				<tr>
				    <th>#</th>
				    <th>{{__('user.display name label')}}</th>
				    <th>{{__('announcement.read time')}}</th>
				</tr>
			    </thead>
			    <tbody>
				<?php $i = 0; ?>
				@foreach($users as $u)
				<tr>
				    <td>
					{{++$i}}
				    </td>
				    <td>
					{{Gravitas\API::image($u['user']->email, 32, '', array('class' => 'img-circle'))}} 
					{{HTML::link(URL::to_action('user@view_profile', array($u['user']->id)),$u['user']->display_name)}}
				    </td>
				    <td>
					{{$u['time']->format('Y-m-d H:i:s')}}
				    </td>
				</tr>
				@endforeach
			    </tbody>
			</table>
		    </div>
		    <div>
			{{$paginate_link}}
		    </div>
		</fieldset>
	    </div>

	</div>
	<div class='span3'>
	    <div class='sidebar'>
<?php echo render('shared._announcement_sidebar', compact('announcement')) ?>
	    </div>
	</div>
    </div>
</div>
@endsection
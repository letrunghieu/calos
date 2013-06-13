@layout('layout.inner')
<?php
?>
@section('page-content')
<div id='page-dashboard' class='container'>
    <div class='row'>
	<h2 class='span12'>{{$org->name}}</h2>
    </div>
    <div class='row'>
	<section class='span9'>
	    <div id='announcements'>
		<h3>{{__('announcement.latest announcement label')}}</h3>
		<?php echo render('shared._list_announcements', compact('announcements')) ?>

	    </div>
	</section>
	<aside class='span3'>
	    <ul class='nav nav-list'>
		<li class="nav-header">{{__('organization.my units')}}</li>
		@foreach($vacancies as $v)
		<li>
		    <a href='{{URL::to_action('organization@view_unit', array($v->unit->id))}}'>{{$v->unit->name}}</a>
		</li>
		@endforeach

	    </ul>
	</aside>
    </div>

</div>
@endsection
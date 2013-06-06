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
	</aside>
    </div>

</div>
@endsection
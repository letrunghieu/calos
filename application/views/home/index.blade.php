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
		<p>
		    {{__('announcement.your latest %d announcements (%d unread)', array(5,3))}}
		</p>
		
	    </div>
	    <div class="row" id='task_today'>
		<h3>Your today tasks</h3>
	    </div>
	    <div class="row" id='task_delayed'>
		<h3>Your delayed tasks</h3>
	    </div>
	    <div class="row" id='task_assign'>
		<h3>Tasks you have assigned</h3>
	    </div>
	</section>
	<aside class='span3'>
	    <nav id='sidebar-nav-holder' class='vertical-nav' gumby-fixed='120'>
		<ul id='sidebar-nav' class='nav nav-stacked nav-tabs'>
		    <li>
			<a class='skip' gumby-goto='#announcements'>Thông báo</a>
		    </li>
		    <li>
			<a class='skip' gumby-goto='#task_today'>Công việc hôm nay</a>
		    </li>
		    <li>
			<a class='skip' gumby-goto='#task_delayed'>Công việc bị trễ</a>
		    </li>
		    <li>
			<a class='skip' gumby-goto='#task_assign'>Công việc đã giao</a>
		    </li>
		</ul>
	    </nav>
	</aside>
    </div>

</div>
@endsection
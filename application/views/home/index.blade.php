@layout('layout.inner')
@section('page-content')
<div id='page-dashboard'>
    <div class='row'>
	<h2>Dashboard</h2>
    </div>
    <div class='row'>
	<section class='ten columns'>
	    <div class="row" id='announcements'>
		<h3>{{__('announcement.announcement label')}}</h3>
		<p>
		    {{__('announcement.your latest %d announcements (%d unread)', array(5,3))}}
		</p>
		<div id='announcements_container'>
		    <div class='announcement'>
			<div class='pull_left time'>
			    <i class='icon-vcard'></i><strong>
				<time datetime="2013-06-01">2013-06-01 12:00</time>
			    </strong>
			</div>
			<div class='pull_right from'>
			    <span>{{__('announcement.from')}}</span> <strong>Ban Nội dung</strong>
			</div>
			<div class='clearfix'></div>
			<div class='title'>
			    <a href='#'>
				Jesu Dionysiadem in modo ad nomine Stranguillio cum magna anima haec in lucem genero in deinde cupis auras.
			    </a>
			</div>
		    </div>
		    <div class='announcement unread'>
			<div class='pull_left time'>
			    <i class='icon-vcard'></i><strong>
				<time datetime="2013-06-01">2013-06-01 12:00</time>
			    </strong>
			    <span class='label primary'>Chưa đọc</span>
			</div>
			<div class='pull_right from'>
			    <span>{{__('announcement.from')}}</span> <strong>Ban Nội dung</strong>
			</div>
			<div class='clearfix'></div>
			<div class='title'>
			    <a href='#'>
				Jesu Dionysiadem in modo ad nomine Stranguillio cum magna anima haec in lucem genero in deinde cupis auras.
			    </a>
			</div>
		    </div>
		    <div class='announcement'>
			<div class='pull_left time'>
			    <i class='icon-vcard'></i><strong>
				<time datetime="2013-06-01">2013-06-01 12:00</time>
			    </strong>
			</div>
			<div class='pull_right from'>
			    <span>{{__('announcement.from')}}</span> <strong>Ban Nội dung</strong>
			</div>
			<div class='clearfix'></div>
			<div class='title'>
			    <a href='#'>
				Jesu Dionysiadem in modo ad nomine Stranguillio cum magna anima haec in lucem genero in deinde cupis auras.
			    </a>
			</div>
		    </div>
		    <div class='announcement unread'>
			<div class='pull_left time'>
			    <i class='icon-vcard'></i><strong>
				<time datetime="2013-06-01">2013-06-01 12:00</time>
			    </strong>
			    <span class='label primary'>Chưa đọc</span>
			</div>
			<div class='pull_right from'>
			    <span>{{__('announcement.from')}}</span> <strong>Ban Nội dung</strong>
			</div>
			<div class='clearfix'></div>
			<div class='title'>
			    <a href='#'>
				Jesu Dionysiadem in modo ad nomine Stranguillio cum magna anima haec in lucem genero in deinde cupis auras.
			    </a>
			</div>
		    </div>
		</div>
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
	<aside class='four columns'>
	    <nav id='sidebar-nav-holder' class='vertical-nav' gumby-fixed='120'>
		<ul id='sidebar-nav'>
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
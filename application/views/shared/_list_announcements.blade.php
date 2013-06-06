<div id='announcements_container'>
    @foreach($announcements as $an)
    <div class='announcement {{$an->is_read ?: "unread"}}'>
	<div class='pull_left time'>
	    <i class='icon icon-calendar'></i><strong>
		<time datetime="{{ $an->created_at }}">{{$an->created_at }}</time>
	    </strong>
	    @if(!$an->is_read)
	    <span class='label label-important'>{{ __('announcement.unread')}}</span>
	    @endif
	</div>
	<div class='pull_right from'>
	    <span>{{__('announcement.from')}}</span> <strong>{{HTML::link(URL::to_action('organization@view_unit',array($an->org_unit->id)), $an->org_unit->name)}}</strong>
	</div>
	<div class='clearfix'></div>
	<div class='title'>
	    <a href='{{URL::to_action('announcement@view', array($an->id))}}'>
	       {{$an->title}}
	</a>
    </div>
</div>
@endforeach
</div>
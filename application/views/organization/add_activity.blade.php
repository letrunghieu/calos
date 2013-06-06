@layout('layout.inner')
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id="view_org_structure" class="page container">
    <div class="row">

    </div>
    <div class='row'>
	<div class='span9'>
	    <h2>{{__('organization.add activity')}}<br /><small>{{ $org_unit->name }}</small></h2>
	    <div>
		<?php echo isset($messages) ? render('shared._message', array('messages' => $messages)) : ""; ?>
	    </div>
	    <?php echo Form::open(URL::current()) ?>
	    <p class='field'>
		<?php echo Form::label('title', __('announcement.title')) ?>
		<?php echo Form::text('title', Input::get('title'), array('class' => 'input-block-level')) ?>
	    </p>
	    <div class='field'>
		<?php echo Form::label('content', __('announcement.content')) ?>
		<?php echo Form::textarea('content', Input::get('content'), array('class' => 'textarea input')) ?>
	    </div>
	    <div>
		<?php echo Form::label('deadline', __('activity.deadline')) ?>
		<div class="input-append date" data-date='{{date('d-m-Y')}}' id="dp3" data-date-format="dd-mm-yyyy">
		    <input class="span2" size="16" type="text" name='deadline'>
		    <span class="add-on"><i class="icon-th"></i></span>
		</div>
	    </div>
	    <div>
		<?php echo Form::label('assignee_id', __('activity.assignee')) ?>
		<select name='assignee_id'>
		    @foreach($members as $m)
		    <option value='{{$m->id}}'>{{$m->display_name}}</option>
		    @endforeach
		</select>
	    </div>
	    <div>
		<?php echo Form::submit(__('common.create'), array('name' => 'commit', 'class' => 'btn btn-large btn-primary')) ?>
	    </div>
	    </p>
	    <?php echo Form::close(); ?>

	</div>
	<div class='span3'>
	    <div class='sidebar'>
		@render('shared._org_unit_sidebar', array('org_unit' => $org_unit))
	    </div>
	</div>
    </div>
</div>
@endsection

@section('foot_scripts')

<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
    tinymce.init({
	selector: "textarea",
	theme: "modern",
	plugins: [
	    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	    "searchreplace wordcount visualblocks visualchars code fullscreen",
	    "insertdatetime media nonbreaking save table contextmenu directionality",
	    "emoticons template paste textcolor"
	],
	toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	toolbar2: "print preview media | forecolor backcolor emoticons",
	image_advtab: true,
	templates: [
	    {title: 'Test template 1', content: 'Test 1'},
	    {title: 'Test template 2', content: 'Test 2'}
	],
    });

</script>
@endsection
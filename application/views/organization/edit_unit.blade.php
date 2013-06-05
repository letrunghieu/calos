@layout('layout.inner')
<?php

function write_option($data, $selected_id, $depth = 0)
{
    $padding = str_repeat('_', $depth);
    $selected = ($data['item']->id == $selected_id) ? "selected" : "";
    $output = <<<HTML
<option value='{$data['item']->id}' {$selected}>
{$padding}{$data['item']->name}		
</option>
HTML;
    echo $output;
    foreach ($data['children'] as $d)
    {
	write_option($d, $selected_id, $depth + 1);
    }
}
?>
<?php
$current_user = \CALOS\Repositories\UserRepository::current_user();
?>
@section('page-content')
<div id="view_org_structure" class="page container">
    <div class="row">

    </div>
    <div class='row'>
	<div class='ten columns'>
	    <h2>{{ $org_unit->name }}</h2>
	    <div>
		<?php echo isset($messages) ? render('shared._message', array('messages' => $messages)) : ""; ?>
	    </div>
	    <?php echo Form::open(URL::current()) ?>
	    <p class='field'>
		<?php echo Form::label('name', __('organization.name')) ?>
		<?php echo Form::text('name', $org_unit->name, array('class' => 'text input')) ?>
	    </p>
	    <div class='field'>
		<?php echo Form::label('description', __('organization.description')) ?>
		<?php echo Form::textarea('description', $org_unit->description, array('class' => 'textarea input')) ?>
	    </div>
	    <?php if ($org_unit->parent_id): ?>
    	    <div class='field'>
		    <?php echo Form::label('parent_id', __('organization.parent unit')) ?>
    		<div class='picker'>
    		    <select name='parent_id'>
			    <?php
			    write_option($units, $org_unit->parent_id)
			    ?>
    		    </select>
    		</div>

    	    </div>
	    <?php endif; ?>
	    <p class="field">
		<?php echo Form::label('leader_title', __('organization.leader vacancy name')) ?>
		<?php echo Form::text('leader_title', $leader_vacancy->name, array('class' => 'text input')) ?>
	    </p>
	    <p>
	    <div class='btn large primary'>
		<?php echo Form::submit(__('common.update'), array('name' => 'commit')) ?>
	    </div>
	    </p>
	    <?php echo Form::close(); ?>

	</div>
	<div class='four columns'>
	    <div class='sidebar'>
		<ul class='nopad'>
		    <li class='field'>
			<div class='medium default btn fourteen columns'>
			    <a href='{{URL::to_action("organization@view_unit", array($org_unit->id))}}'>{{__('organization.view unit')}}</a>
			</div>
		    </li>
		</ul>
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
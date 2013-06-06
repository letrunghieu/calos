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
@section('page-content')
<div id="view_org_structure" class="page container">
    <div class="row">

    </div>
    <div class='row'>
	<div class='span9'>
	    <h2>{{ __('user.create') }}</h2>
	    <div>
		<?php echo isset($messages) ? render('shared._message', array('messages' => $messages)) : ""; ?>
	    </div>
	    <?php echo Form::open(URL::current()) ?>
	    <p class='field'>
		<?php echo Form::label('email', __('user.email label')) ?>
		<?php echo Form::text('email', Input::get('title'), array('class' => 'input-xlarge')) ?>
	    </p>
	    <p class='field'>
		<?php echo Form::label('first_name', __('user.first name label')) ?>
		<?php echo Form::text('first_name', Input::get('first_name'), array('class' => 'input-xlarge')) ?>
	    </p>
	    <p class='field'>
		<?php echo Form::label('last_name', __('user.last name label')) ?>
		<?php echo Form::text('last_name', Input::get('last_name'), array('class' => 'input-xlarge')) ?>
	    </p>
	    <p class='field'>
		<?php echo Form::label('password', __('user.password label')) ?>
		<?php echo Form::password('password', array('class' => 'input-xlarge')) ?>
	    </p>
	    <p class='field'>
		<?php echo Form::label('repassword', __('user.repassword label')) ?>
		<?php echo Form::password('repassword', array('class' => 'input-xlarge')) ?>
	    </p>
	    <div class='field'>
		<?php echo Form::label('unit_id', __('user.parent unit')) ?>
		<div class='picker'>
		    <select name='unit_id' class='input-xxlarge'>
			<?php
			write_option($units, Input::get('parent_id'))
			?>
		    </select>
		</div>

	    </div>
	    <p>
	    <div>
		<?php echo Form::submit(__('common.create'), array('name' => 'commit', 'class'=> 'btn btn-large btn-primary')) ?>
	    </div>
	    </p>
	    <?php echo Form::close(); ?>

	</div>
	<div class='span3'>
	    <div class='sidebar'>
	    </div>
	</div>
    </div>
</div>
@endsection

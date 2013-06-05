<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h3><?php echo __('organization.direct members'); ?></h3>
<div class='org_vacancies'>
    <?php foreach ($vacancies as $v): ?>
        <div class='vacancy'>
	    <?php foreach ($v->members as $m): ?>
		<div class='member'>
		    <div>
			<div class='pull_left avatar'>
			    <?php echo Gravitas\API::image($m->email, 64) ?>
			</div>
			<div class='pull_left'>
			    <p class='name'><?php echo HTML::link(URL::to_action('user@view_profile', array($m->id)), $m->display_name) ?><p>
			    <div class='vacancy-name'>
				<?php echo $v->name ?>
			    </div>
			</div>
			<div class='clearfix'>
			</div>
		    </div>
		</div>
	    <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
<div>
    <h3><?php echo __('organization.children units'); ?></h3>
    <div class='org_units'>
	<?php foreach ($children as $c): ?>
    	<div class='org_unit'>
    	    <p>
		    <?php echo HTML::link(URL::to_action('organization@view_unit', array($c->id)), $c->name) ?>
    	    </p>
    	</div>
	<?php endforeach; ?>
    </div>
</div>

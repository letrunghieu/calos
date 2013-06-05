<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php foreach ($messages as $msg_type => $msgs): ?>

    <div class="alert <?php echo $msg_type ?>">
	<?php foreach ($msgs as $msg): ?>
	    <p>
		<?php echo $msg; ?>
	    </p>
	<?php endforeach; ?>
    </div>

<?php endforeach; ?>


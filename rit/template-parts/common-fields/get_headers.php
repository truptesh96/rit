<?php 
	$head_tag = get_sub_field('head_tag') ? get_sub_field('head_tag') : "h2";
	$heading = get_sub_field('heading');
	$sub_head_tag = get_sub_field('sub_head_tag') ? get_sub_field('sub_head_tag') : "h2";
	$sub_heading = get_sub_field('sub_heading');
?>

<?php if($heading): ?>
	<<?php echo $head_tag; ?> class="head">
		<?php echo $heading; ?>
	</<?php echo $head_tag; ?>>
<?php endif; ?>

<?php if($sub_head_tag): ?>
	<<?php echo $sub_head_tag; ?> class="subHead">
		<?php echo $sub_heading; ?>
	</<?php echo $sub_head_tag; ?>>
<?php endif; ?>